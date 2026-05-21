import AppLayout from '@/Layouts/AppLayout'
import { useForm } from '@inertiajs/react'
import { useState } from 'react'

export default function ReturnInter({ items }) {
    const [quantities, setQuantities] = useState({})
    const [search, setSearch] = useState('')
    const { data, setData, post, processing } = useForm({ comment: '' })

    function changeQuantity(itemId, delta) {
        setQuantities(prev => ({
            ...prev,
            [itemId]: (prev[itemId] || 0) + delta
        }))
    }

    const filteredItems = items.filter(item =>
        item.name.toLowerCase().includes(search.toLowerCase())
    )

    function submit(e) {
        e.preventDefault()
        const formData = { comment: data.comment }
        items.forEach(item => {
            formData[`id${item.id}`] = quantities[item.id] || 0
        })
        post('/return-inter/validate', { data: formData })
    }

    return (
        <div className="return-inter-page page">
            <h1 className="title-user">Retours d'intervention</h1>
            <p className="instruction">Renseignez les éléments pris dans la réserve</p>

            <div className="search-container">
                <label>Rechercher un item</label>
                <input
                    type="text"
                    placeholder="Tapez pour filtrer les items..."
                    id="search"
                    value={search}
                    onChange={e => setSearch(e.target.value)}
                />
                <small id="result-count">{filteredItems.length} item(s) affiché(s)</small>
            </div>

            <form className="form-container" onSubmit={submit}>
                <div className="item-grid" id="items-container">
                    {filteredItems.length > 0 ? filteredItems.map(item => {
                        const qty = quantities[item.id] || 0
                        return (
                            <div key={item.id} className="item-card">
                                <label className="item-label">{item.name}</label>
                                <div className="end">
                                    <div className="item-controls">
                                        <button type="button" className="btn-quantity minus"
                                                onClick={() => changeQuantity(item.id, -1)}>−</button>
                                        <div className={`quantity-display ${qty > 0 ? 'quantity-positive' : qty < 0 ? 'quantity-negative' : 'quantity-zero'}`}>
                                            {qty > 0 ? `+${qty}` : qty}
                                        </div>
                                        <button type="button" className="btn-quantity plus"
                                                onClick={() => changeQuantity(item.id, 1)}>+</button>
                                    </div>
                                </div>
                            </div>
                        )
                    }) : (
                        <div style={{ textAlign: 'center', padding: '40px 0', color: '#7f8c8d' }}>
                            <p style={{ fontSize: 18, margin: 0 }}>Aucun item trouvé</p>
                            <p style={{ margin: '10px 0 0 0', fontSize: 14 }}>Essayez avec un autre terme de recherche</p>
                        </div>
                    )}
                </div>

                <div className="form-bottom">
                    <div className="comment-container">
                        <label>
                            Commentaire : <span style={{ fontStyle: 'italic', fontSize: 10 }}>(Facultatif)</span>
                        </label>
                        <input
                            id="comment"
                            name="comment"
                            value={data.comment}
                            onChange={e => setData('comment', e.target.value)}
                        />
                        <button type="submit" className="btn" disabled={processing}>Valider</button>
                    </div>
                </div>
            </form>
        </div>
    )
}

ReturnInter.layout = page => <AppLayout>{page}</AppLayout>
