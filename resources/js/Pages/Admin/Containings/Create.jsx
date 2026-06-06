import AppLayout from '@/Layouts/AppLayout'
import { useForm, router } from '@inertiajs/react'
import { useState } from 'react'

export default function Create({sources}) {
    const { data, setData, post, errors } = useForm({
        name: '',
        source_id: 0,
    })

    function submit(e) {
        e.preventDefault()
        const formData = { 
            name: data.name,
            source_id: data.source_id,
         }

        router.post('/admin/containings/store', formData)
    }

    return (
        <div className="admin-page">
            <h1 className="title-user">Ajouter un Contenant</h1>

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
                        Nom du contenant <span style={{ color: '#e74c3c' }}>*</span>
                    </label>
                    <input
                        type="text"
                        className="input-field"
                        placeholder="Ex : Compresses stériles"
                        value={data.name}
                        onChange={e => setData('name', e.target.value)}
                        required
                    />

                    <label htmlFor="source_id">Source associé</label>
                    <select className="source_id input-field" name="source_id"  onChange={e => setData('source_id', e.target.value)} required >
                        {sources.map(source =>
                        {
                              var name = source.name;
                              var source_id = source.id;
                              return(
                                   <option value={source.id}>{source.name}</option>
                              )
                        })}
                    </select>
                </div>

                <button type="submit" className="btn-save btn-success">Enregistrer</button>
            </form>
        </div>
    )
}

Create.layout = page => <AppLayout>{page}</AppLayout>
