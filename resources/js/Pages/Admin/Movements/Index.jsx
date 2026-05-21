import AppLayout from '@/Layouts/AppLayout'

export default function Index({ movements }) {
    return (
        <div className="admin-page">
            <h1 className="title-user">Mouvements de Stock</h1>

            <div className="list-movement">
                {movements.length > 0 ? movements.map(movement => (
                    <div key={movement.id} className="card">
                        <div className="row">
                            <p>{movement.user.firstname} {movement.user.lastname}</p>
                            <p className="date">
                                {new Date(movement.created_at).toLocaleDateString('fr-FR')}
                                {' '}
                                {new Date(movement.created_at).toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })}
                            </p>
                        </div>

                        <div className="divider"></div>

                        <div className="list-item">
                            {movement.items.map(item => (
                                <div key={item.id} className="item">
                                    {item.pivot.operation > 0 ? (
                                        <span style={{ backgroundColor: '#d4edda', color: '#155724', padding: '3px 8px', borderRadius: 12, fontSize: 12, fontWeight: 'bold', minWidth: 40, textAlign: 'center' }}>
                                            +{item.pivot.operation}
                                        </span>
                                    ) : (
                                        <span style={{ backgroundColor: '#f8d7da', color: '#721c24', padding: '3px 8px', borderRadius: 12, fontSize: 12, fontWeight: 'bold', minWidth: 40, textAlign: 'center' }}>
                                            {item.pivot.operation}
                                        </span>
                                    )}
                                    <span style={{ color: '#495057' }}>{item.name}</span>
                                </div>
                            ))}
                        </div>

                        {movement.comment && movement.comment.length > 1 && (
                            <div className="comment">
                                <p><b>Commentaire :</b></p>
                                <p style={{ fontStyle: 'italic' }}>"{movement.comment}"</p>
                            </div>
                        )}
                    </div>
                )) : (
                    <div>
                        <p style={{ fontSize: 18, margin: 0 }}>Aucun mouvement enregistré</p>
                        <p style={{ margin: '10px 0 0 0', fontSize: 14 }}>
                            Les mouvements apparaîtront ici lorsque des utilisateurs feront des retours d'intervention.
                        </p>
                    </div>
                )}
            </div>
        </div>
    )
}

Index.layout = page => <AppLayout>{page}</AppLayout>
