import AppLayout from '../../Layouts/AppLayout'
import { Link } from '@inertiajs/react'
import React from 'react'

export default function Index({ totalItems, movementsThisMonth, lowStockItems, lowStockCount }) {
    return (
        <div className="admin-page">
            <h1 className="title-user">Statistique</h1>
            <div className="card-stat-list">
                <div className="card" style={{ background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' }}>
                    <h3>Total Items</h3>
                    <p>{totalItems}</p>
                </div>
                <div className="card" style={{ background: 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)' }}>
                    <h3>Mouvements ce mois</h3>
                    <p>{movementsThisMonth}</p>
                </div>
                <div className="card" style={{ background: 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)' }}>
                    <h3>Alertes Stock</h3>
                    <p>{lowStockCount}</p>
                </div>
            </div>
            <h1 className="title-user">Rupture de stock</h1>
            {lowStockItems.length > 0 ? (
                <div className="list-item-rupture">
                    {lowStockItems.map(item => (
                        <Link key={item.id} className="card" href={`/admin/items/edit/${item.id}`}>
                            <p className="name">{item.name}</p>
                            <p style={{ fontSize: 18, fontWeight: 'bold', color: item.total_qty <= 0 ? '#e74c3c' : '#f39c12' }}>
                                {item.total_qty}
                            </p>
                        </Link>
                    ))}
                </div>
            ) : (
                <div style={{ textAlign: 'center', padding: '40px 0', color: '#28a745' }}>
                    <p style={{ fontSize: 18, margin: 0 }}>Aucun article en alerte de stock !</p>
                    <p style={{ color: '#7f8c8d', marginTop: 10 }}>Tous vos stocks sont au-dessus des seuils d'alerte.</p>
                </div>
            )}
        </div>
    )
}

Index.layout = page => <AppLayout>{page}</AppLayout>
