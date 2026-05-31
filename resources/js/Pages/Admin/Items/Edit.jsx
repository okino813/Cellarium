import AppLayout from '@/Layouts/AppLayout'
import { useForm, Link, router } from '@inertiajs/react'

export default function Edit({ item }) {
    const { data, setData, put, errors } = useForm({
        name: item.name,
        is_stock: item.is_stock == 1,
        state: item.state == 1,
        total_qty: item.total_qty,
        seuil: item.seuil,
    })

    function submit(e) {
        e.preventDefault()
        const formData = {
            name: data.name,
            is_stock: data.is_stock,
            state: data.state,
            total_qty: data.total_qty,
            seuil: data.seuil,
        }

        console.log(formData);
        router.put(`/admin/items/update/${item.id}`, formData)
    }

    return (
        <div className="admin-page">
            <h1 className="title-user">Modifier l'Item</h1>
            <p className="instruction">Modifiez les informations de <strong>{item.name}</strong></p>

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
                    <input type="text" className="input-field" placeholder="Ex : Compresses stériles"
                           value={data.name} onChange={e => setData('name', e.target.value)} required />
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

                <Link href={`/admin/items/delete/${item.id}`} className="btn-delete">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M136.7 5.9L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-8.7-26.1C306.9-7.2 294.7-16 280.9-16L167.1-16c-13.8 0-26 8.8-30.4 21.9zM416 144L32 144 53.1 467.1C54.7 492.4 75.7 512 101 512L347 512c25.3 0 46.3-19.6 47.9-44.9L416 144z"/></svg>
                    Supprimer
                </Link>

                <button type="submit" className="btn-save btn-success">Enregistrer</button>
            </form>
        </div>
    )
}

Edit.layout = page => <AppLayout>{page}</AppLayout>
