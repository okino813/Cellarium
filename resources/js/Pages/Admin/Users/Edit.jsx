import AppLayout from '@/Layouts/AppLayout'
import { useForm, Link, router } from '@inertiajs/react'

export default function Edit({ user, perm }) {
    const { data, setData, put, errors } = useForm({
        firstname: user.firstname,
        lastname: user.lastname,
        email: user.email,
        matricule: user.matricule,
        isAdmin: user.isAdmin,
        isAdminChief: user.isAdminChief,
        password : null,
        firestation_id: user.firestation_id
    })

    function submit(e) {
        e.preventDefault()
        const formData = {
            firstname: data.firstname,
            lastname: data.lastname,
            email: data.email,
            matricule: data.matricule,
            isAdmin: data.isAdmin,
            isAdminChief: data.isAdminChief,
            password: data.password,
            firestation_id: data.firestation_id,
        }

        console.log(formData);
        router.put(`/admin/users/update/${user.id}`, formData)
    }

    return (
        <div className="admin-page">
            <h1 className="title-user">Modifier l'utilisateur</h1>
            <p className="instruction">Modifiez les informations de <strong>{user.name}</strong></p>

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
                        Prénom <span style={{ color: '#e74c3c' }}>*</span>
                    </label>
                    <input type="text" className="input-field" placeholder="Horace"
                           value={data.firstname} onChange={e => setData('firstname', e.target.value)} required />

                    <label>
                        Nom <span style={{ color: '#e74c3c' }}>*</span>
                    </label>
                    <input type="text" className="input-field" placeholder="Velmont"
                           value={data.lastname} onChange={e => setData('lastname', e.target.value)} required />


                    <label>
                        Matricule <span style={{ color: '#e74c3c' }}>*</span>
                    </label>
                    <input type="text" className="input-field" placeholder="489247"
                           value={data.matricule} onChange={e => setData('matricule', e.target.value)} required />
                </div>
                {perm == 1 && (
                    <div className="card form-item">
                        <div className="field">
                            <label>
                                Est un admin ?
                            </label>
                            <label className="switch">
                                <input type="checkbox" checked={data.isAdmin} onChange={e => setData('isAdmin', e.target.checked)} />
                                <span className="slider round"></span>
                            </label>
                        </div>
                    </div>
                )}


                {(data.isAdmin == 1 && perm == 1) && (
                    <div className="card form-item">
                        <div className="field">
                            <label>
                                Est un chef de centre ?
                            </label>
                            <label className="switch">
                                <input type="checkbox" checked={data.isAdminChief} onChange={e => setData('isAdminChief', e.target.checked)} />
                                <span className="slider round"></span>
                            </label>
                        </div>

                        <hr />

                              <label>
                            Email <span style={{ color: '#e74c3c' }}>*</span>
                        </label>
                        <input type="email" className="input-field" placeholder="Mot de passe"
                            value={data.email} onChange={e => setData('email', e.target.value)} required/>

                        <label>
                            Mot de passe
                        </label>
                        <p className="instruction-label">Remplissez ce champs si modification</p>
                        <input type="password" className="input-field" placeholder="Mot de passe"
                            value={data.password} onChange={e => setData('password', e.target.value)} />
                    </div>
                )}


                

                <Link href={`/admin/users/delete/${user.id}`} className="btn-delete">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M136.7 5.9L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-8.7-26.1C306.9-7.2 294.7-16 280.9-16L167.1-16c-13.8 0-26 8.8-30.4 21.9zM416 144L32 144 53.1 467.1C54.7 492.4 75.7 512 101 512L347 512c25.3 0 46.3-19.6 47.9-44.9L416 144z"/></svg>
                    Supprimer
                </Link>

                <button type="submit" className="btn-save btn-success">Enregistrer</button>
            </form>
        </div>
    )
}

Edit.layout = page => <AppLayout>{page}</AppLayout>
