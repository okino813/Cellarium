import AppLayout from '@/Layouts/AppLayout'
import { useForm } from '@inertiajs/react'
import { useState } from 'react'

export default function Create() {
    const { data, setData, post, errors } = useForm({
        name: '',
        is_stock: false,
        state: true,
        total_qty: 0,
        seuil: 0,
    })

    function submit(e) {
        e.preventDefault()
        post('/admin/items')
    }

    return (
        <div className="admin-page">
            <h1 className="title-user">Ajout d'un item</h1>

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
                    <label style={{ marginBottom: 8, fontWeight: 600, color: '#2c3e50' }}>
                        Nom de l'item <span style={{ color: '#e74c3c' }}>*</span>
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

                <div className="card form-item">
                    <div className="field">
                        <label style={{ display: 'block', marginBottom: 8, fontWeight: 600, color: '#2c3e50' }}>
                            Cet item est-il stocké ?
                        </label>
                        <label className="switch">
                            <input type="checkbox" checked={data.is_stock} onChange={e => setData('is_stock', e.target.checked)} />
                            <span className="slider round"></span>
                        </label>
                    </div>
                    <div className="field">
                        <label style={{ display: 'block', marginBottom: 8, fontWeight: 600, color: '#2c3e50' }}>
                            État de l'item
                        </label>
                        <label className="switch">
                            <input type="checkbox" checked={data.state} onChange={e => setData('state', e.target.checked)} />
                            <span className="slider round"></span>
                        </label>
                    </div>
                    <small style={{ color: '#7f8c8d', fontSize: 13 }}>Les items désactivés n'apparaissent pas dans les vérifications</small>
                </div>

                {data.is_stock && (
                    <div className="card stock_fields">
                        <div style={{ marginBottom: 20 }}>
                            <label style={{ display: 'block', marginBottom: 8, fontWeight: 600, color: '#2c3e50' }}>
                                Quantité en stock <span style={{ color: '#e74c3c' }}>*</span>
                            </label>
                            <input type="number" className="input-field" placeholder="0" min="0"
                                   value={data.total_qty} onChange={e => setData('total_qty', e.target.value)} />
                            <small style={{ color: '#7f8c8d', fontSize: 13 }}>Quantité actuellement disponible</small>
                        </div>
                        <div style={{ marginBottom: 20 }}>
                            <label style={{ display: 'block', marginBottom: 8, fontWeight: 600, color: '#2c3e50' }}>
                                Seuil d'alerte <span style={{ color: '#e74c3c' }}>*</span>
                            </label>
                            <input type="number" className="input-field" placeholder="10" min="0"
                                   value={data.seuil} onChange={e => setData('seuil', e.target.value)} />
                            <small style={{ color: '#7f8c8d', fontSize: 13 }}>Vous serez alerté quand le stock atteint ce seuil</small>
                        </div>
                    </div>
                )}

                <button type="submit" className="btn-save btn-success">Enregistrer</button>
            </form>
        </div>
    )
}

Create.layout = page => <AppLayout>{page}</AppLayout>
