import AppLayout from '@/Layouts/AppLayout'
import { useForm, Link, router } from '@inertiajs/react'

export default function Edit({ source }) {
    const { data, setData, put, errors } = useForm({
        id: source.id,
        name: source.name,
    })

    function submit(e) {
        e.preventDefault()
        const formData = {
            id: data.id,
            name: data.name,
        }

        console.log(formData);
        router.put(`/admin/sources/update/${source.id}`, formData)
    }

    return (
        <div className="admin-page">
            <h1 className="title-user">Modifier la source</h1>
            <p className="instruction">Modifiez les informations de <strong>{source.name}</strong></p>

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
                        Nom de la source <span style={{ color: '#e74c3c' }}>*</span>
                    </label>
                    <input type="text" className="input-field" placeholder="Ex : Compresses stériles"
                           value={data.name} onChange={e => setData('name', e.target.value)} required />
                </div>

                <Link href={`/admin/sources/delete/${data.id}`} className="btn-delete">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M136.7 5.9L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-8.7-26.1C306.9-7.2 294.7-16 280.9-16L167.1-16c-13.8 0-26 8.8-30.4 21.9zM416 144L32 144 53.1 467.1C54.7 492.4 75.7 512 101 512L347 512c25.3 0 46.3-19.6 47.9-44.9L416 144z"/></svg>
                    Supprimer
                </Link>

                <button type="submit" className="btn-save btn-success">Enregistrer</button>
            </form>
        </div>
    )
}

Edit.layout = page => <AppLayout>{page}</AppLayout>
