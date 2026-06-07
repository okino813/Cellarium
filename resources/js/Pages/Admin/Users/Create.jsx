import AppLayout from '@/Layouts/AppLayout'
import { useForm, router } from '@inertiajs/react'
import { useState } from 'react'

export default function Create({perm}) {
    const { data, setData, post, errors } = useForm({
        firstname: null,
        lastname: null,
        email: null,
        matricule: null,
        isAdmin: null,
        isAdminChief: null,
        password : null,
        firestation_id: null
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
         }

        router.post('/admin/users/store', formData)
    }

    return (
        <div className="admin-page">
            <h1 className="title-user">Ajouter un utilisateur</h1>

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
                        <input type="email" className="input-field" placeholder="Adresse mail"
                            value={data.email} onChange={e => setData('email', e.target.value)} required />
                        
                        <label>
                            Mot de passe
                        </label>
                        <p className="instruction-label">Remplissez ce champs si modification</p>
                        <input type="password" className="input-field" placeholder="Mot de passe"
                            value={data.password} onChange={e => setData('password', e.target.value)} />
                    </div>
                )}



                <button type="submit" className="btn-save btn-success">Enregistrer</button>
            </form>
        </div>
    )
}

Create.layout = page => <AppLayout>{page}</AppLayout>
