import AppLayout from '@/Layouts/AppLayout'
import { useForm, router } from '@inertiajs/react'
import { useState } from 'react'

export default function Create() {
    const { data, setData, post, errors } = useForm({
        name: '',
    })

    function submit(e) {
        e.preventDefault()
        const formData = { 
            name: data.name
         }

        router.post('/admin/sources/store', formData)
    }

    return (
        <div className="admin-page">
            <h1 className="title-user">Ajouter une source</h1>

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
                    <input
                        type="text"
                        className="input-field"
                        placeholder="Ex : Compresses stériles"
                        value={data.name}
                        onChange={e => setData('name', e.target.value)}
                        required
                    />
                </div>

                <button type="submit" className="btn-save btn-success">Enregistrer</button>
            </form>
        </div>
    )
}

Create.layout = page => <AppLayout>{page}</AppLayout>
