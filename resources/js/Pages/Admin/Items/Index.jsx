import AppLayout from '@/Layouts/AppLayout'
import { Link } from '@inertiajs/react'

export default function Index({ items }) {
    return (
        <div className="admin-page">
            <h1 className="title-user">Liste des Items</h1>
            <p className="instruction">Gérez tous les items du stock</p>

            <Link href="/admin/items/create" className="btn-add">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 160-160 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l160 0 0 160c0 17.7 14.3 32 32 32s32-14.3 32-32l0-160 160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-160 0 0-160z"/></svg>
            </Link>

            <div className="list-item-admin">
                {items.length > 0 ? items.map(item => (
                    <Link key={item.id} className="card" href={`/admin/items/edit/${item.id}`}>
                        <div className="name-seuil">
                            <p>{item.name}</p>
                            {item.is_stock && <p className="seuil">Seuil : {item.seuil}</p>}
                        </div>
                        <div className="qty-status">
                            <div className="qty">
                                {!item.is_stock ? (
                                    <div className="background"><p>Non stocké</p></div>
                                ) : (
                                    <span className="print" style={{ color: item.total_qty <= item.seuil ? '#e74c3c' : '#28a745' }}>
                                        {item.total_qty}
                                    </span>
                                )}
                                {item.is_stock && (
                                    item.total_qty <= item.seuil
                                        ? <div className="background-rupture"><p>Rupture</p></div>
                                        : <div className="background-ok"><p>Ok</p></div>
                                )}
                            </div>
                        </div>
                    </Link>
                )) : (
                    <div>
                        <p>Aucun item trouvé</p>
                        <Link href="/admin/items/create" style={{ color: '#007bff', textDecoration: 'underline' }}>
                            Ajouter votre premier item
                        </Link>
                    </div>
                )}
            </div>
        </div>
    )
}

Index.layout = page => <AppLayout>{page}</AppLayout>
