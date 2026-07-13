import AppLayout from '@/Layouts/AppLayout'
import { useState } from 'react'

import { useForm, Link, router } from '@inertiajs/react'

export default function Edit({ contenant, sources, items }) {
    const [showModal, setShowModal] = useState(false)
    const { data, setData, put, errors } = useForm({
        name: contenant.name,
        source_id: contenant.source_id,
        firestation_id: contenant.firestation_id
    })

    // Formulaire de la modale "Ajouter une association"
    const addForm = useForm({
        contenant: contenant.id,
        item: '',
        qty: 1,
    })

    function submitAddItem(e) {
        e.preventDefault()
        addForm.post('/admin/attribution/addItemContaining/validate', {
            onSuccess: () => {
                setShowModal(false)
                addForm.reset()
            }
        })
    }

    function submit(e) {
        e.preventDefault()
        const formData = {
            name: data.name,
            source_id: data.source_id,
            firestation_id: data.firestation_id,
        }

        console.log(formData);
        router.put(`/admin/containings/update/${contenant.id}`, formData)
    }

    function cancelEdit(button) {
        const container = button.parentElement;
        const row = container.closest('tr');
        const itemId = row.getAttribute('data-item-id');
        const editButton = row.querySelector(`.btn-edit[data-item-id="${itemId}"]`);
        container.style.display = 'none';
        editButton.style.display = 'inline-block';
    }


    function saveQty(itemId, contenantId, newQty) {

        const formData = {
            item_id: itemId,
            containing_id: contenantId,
            qty: newQty,
        }

        console.log(formData);
        router.put(`/admin/attribution/addItemContaining/update/${contenant.id}`, formData,
            {
        preserveScroll: false,
        preserveState: false,
        only: [], // Désactive la preview
    }
        )
    }

    function EditQty(id, operation, contenantId){
        var input = document.getElementById(`item-${id}`);
        var calcule = parseInt(input.value)

        if(operation == "more"){
            calcule = (calcule) + 1
        }else{
            calcule = calcule - 1
        }

        if(calcule>0){
            input.value = calcule
            saveQty(id, contenantId, calcule)
        }
        else{
            const confirmation = confirm("Souhaitez-vous supprimé cet élément ?")
            if(confirmation){
                input.value = calcule
                saveQty(id, contenantId, calcule)
                // On refresh la page
                const items = document.getElementsByClassName(`itemcontainer-${id}`);
                if (items.length > 0) {
                    // Supprime le premier élément trouvé (ou un spécifique si nécessaire)
                    items[0].remove();
                } else {
                    console.log("Aucun élément trouvé avec cette classe.");
                }
            }
        }
    }

    // Items non encore associés au contenant (pour le select de la modale)
    const availableItems = items.filter(
        item => !contenant.items.some(ci => ci.id === item.id)
    )

    return (
        <div className="admin-page">
            <h1 className="title-user">Modifier le contenant</h1>
            <p className="instruction">Modifiez les informations de <strong>{contenant.name}</strong></p>

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
                        Nom de l'item <span style={{ color: '#e74c3c' }}>*</span>
                    </label>
                    <input type="text" className="input-field" placeholder="Ex : Compresses stériles"
                           value={data.name} onChange={e => setData('name', e.target.value)} required />


                    <label htmlFor="source_id">Source associé</label>
                    <select className="source_id input-field" name="source_id"  onChange={e => setData('source_id', e.target.value)} required >
                        {sources.map(source =>
                        {
                            var name = source.name;
                            var source_id = source.id;

                            if(source_id != data.source_id)
                            {
                                return(
                                    <option value={source.id}>{source.name}</option>
                                )
                            }else{
                                return(
                                    <option value={source.id} selected>{source.name}</option>
                                )
                            }
                        })}
                    </select>
                </div>

                <Link href={`/admin/containings/delete/${contenant.id}`} className="btn-delete">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M136.7 5.9L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-8.7-26.1C306.9-7.2 294.7-16 280.9-16L167.1-16c-13.8 0-26 8.8-30.4 21.9zM416 144L32 144 53.1 467.1C54.7 492.4 75.7 512 101 512L347 512c25.3 0 46.3-19.6 47.9-44.9L416 144z"/></svg>
                    Supprimer
                </Link>

                <button type="submit" className="btn-save btn-success">Enregistrer</button>
            </form>

            <h1 className="title-user">Items associé</h1>
            <div className="card list-item-contain">
                {contenant.items.length === 0 ? (
                    <div className='test'>
                        <div style="text-align: center; padding: 40px 0; color: #7f8c8d;">
                            <p style="font-size: 18px; margin: 0;">Aucun item associé</p>
                            <p style="margin: 10px 0 0 0;">
                                Utilisez le formulaire ci-dessus pour ajouter des items
                            </p>
                        </div>
                    </div>
                ) : (
                    contenant.items.map(item => {
                        var id = item.id
                        var name = item.name;
                        var qty = item.pivot.qty_affect
                        
                        return(
                            <div className={`item itemcontainer-${name}`}>
                                <p>{name}</p>

                                <div className="qty-value">
                                    <button onClick={() => EditQty(id, 'minus', contenant.id)} className="left">-</button>
                                    <input type="number" name={`item-${id}`} id={`item-${id}`} value={qty} readOnly />
                                    <button onClick={() => EditQty(id, 'more', contenant.id)}  className="right">+</button>
                                </div>
                            </div>
                        )
                    }
                ))}

                <div className="div-btn">
                    <button onClick={() => setShowModal(true)} className="btn-delete new-assign">
                        + Ajouter une association
                    </button>
                </div>

                {showModal && (

                <div id="modal-add-item" onClick={(e) => { if (e.target.id === 'modal-add-item') setShowModal(false) }}>
                  <form onSubmit={submitAddItem}>
                        <label>
                            Item <span style={{ color: '#e74c3c' }}>*</span>
                        </label>

                        <select
                            value={addForm.data.item}
                            onChange={e => addForm.setData('item', e.target.value)}
                            required>
                            <option value="" disabled>Sélectionner un item...</option>
                            {availableItems.map(item => (
                                <option key={item.id} value={item.id}>{item.name}</option>
                            ))}
                        </select>
                        {addForm.errors.item && (
                            <p style={{ color: '#e74c3c', fontSize: 13, marginTop: 4 }}>{addForm.errors.item}</p>
                        )}

            
                            <label>
                                Quantité affectée <span style={{ color: '#e74c3c' }}>*</span>
                            </label>
                            <input
                                type="number"
                                min="1"
                                value={addForm.data.qty}
                                onChange={e => addForm.setData('qty', e.target.value)}
                                required
                            />
                            {addForm.errors.qty && (
                                <p>{addForm.errors.qty}</p>
                            )}

                            <div className="btns">
                                <button
                                    type="button"
                                    onClick={() => setShowModal(false)}
                                    style={{background: '#b00020' }}
                                >
                                    Annuler
                                </button>
                                <button
                                    type="submit"
                                    disabled={addForm.processing}
                                    style={{ background: '#28a745'}}
                                >
                                    Associer
                                </button>
                            </div>
                    </form>
                </div>

                )}
            </div>


        </div>
    )
}

Edit.layout = page => <AppLayout>{page}</AppLayout>
