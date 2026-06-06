import AppLayout from '@/Layouts/AppLayout'
import { Link } from '@inertiajs/react'

export default function Index({ sources }) {
    return (
        <div className="admin-page">
            <h1 className="title-user">Liste des Sources</h1>
            <p className="instruction">Gérez tous les contenants (sacs, armoires, etc.)</p>

            <Link href="/admin/sources/create" className="btn-add">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 160-160 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l160 0 0 160c0 17.7 14.3 32 32 32s32-14.3 32-32l0-160 160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-160 0 0-160z"/></svg>
            </Link>

            <div className="list-containing-admin">
                {sources.length > 0 ? sources.map(source => (
                    <Link key={source.id} className="card" href={`/admin/sources/edit/${source.id}`}>
                            <p className="name">{source.name}</p>
                    </Link>
                )) : (
                    <div>
                        <p>Aucune source trouvé</p>
                        <Link href="/admin/sources/create" style={{ color: '#007bff', textDecoration: 'underline' }}>
                            Ajouter votre première source
                        </Link>
                    </div>
                )}
            </div>
        </div>
    )
}

Index.layout = page => <AppLayout>{page}</AppLayout>
