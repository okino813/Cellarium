import AppLayout from '@/Layouts/AppLayout'
import { useForm, Link, router } from '@inertiajs/react'

export default function Edit({ contenant, sources, items }) {
    const { data, setData, put, errors } = useForm({
        name: contenant.name,
        source_id: contenant.source_id,
        firestation_id: contenant.firestation_id
    })

    function submit(e) {
        e.preventDefault()
        const formData = {
            name: data.name,
            source_id: data.source_id,
            firestation_id: data.firestation_id,
        }

        console.log(formData);
        router.put(`/admin/containings/update/${contenant.id}`, formData)
    }

    return (
        <div className="admin-page">
            <h1 className="title-user">Modifier le contenant</h1>
            <p className="instruction">Modifiez les informations de <strong>{contenant.name}</strong></p>

            {errors && Object.keys(errors).length > 0 && (
                <div className="alert-error" style={{ marginBottom: 20 }}>
                    <strong>Erreurs :</strong>
                    <ul style={{ margin: '10px 0 0 20px' }}>
                        {Object.values(errors).map((e, i) => <li key={i}>{e}</li>)}
                    </ul>
                </div>
            )}

            <form onSubmit={submit}>
                <div className="card form-item">
                    <label>
                        Nom de l'item <span style={{ color: '#e74c3c' }}>*</span>
                    </label>
                    <input type="text" className="input-field" placeholder="Ex : Compresses stériles"
                           value={data.name} onChange={e => setData('name', e.target.value)} required />


                    <label htmlFor="source_id">Source associé</label>
                    <select className="source_id input-field" name="source_id"  onChange={e => setData('source_id', e.target.value)} required >
                        {sources.map(source =>
                        {
                            var name = source.name;
                            var source_id = source.id;

                            if(source_id != data.source_id)
                            {
                                return(
                                    <option value={source.id}>{source.name}</option>
                                )
                            }else{
                                return(
                                    <option value={source.id} selected>{source.name}</option>
                                )
                            }
                        })}
                    </select>
                </div>

                <Link href={`/admin/containings/delete/${contenant.id}`} className="btn-delete">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M136.7 5.9L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-8.7-26.1C306.9-7.2 294.7-16 280.9-16L167.1-16c-13.8 0-26 8.8-30.4 21.9zM416 144L32 144 53.1 467.1C54.7 492.4 75.7 512 101 512L347 512c25.3 0 46.3-19.6 47.9-44.9L416 144z"/></svg>
                    Supprimer
                </Link>

                <button type="submit" className="btn-save btn-success">Enregistrer</button>
            </form>
        </div>
    )
}

Edit.layout = page => <AppLayout>{page}</AppLayout>
