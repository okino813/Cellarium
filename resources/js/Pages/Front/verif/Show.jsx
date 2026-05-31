import AppLayout from '@/Layouts/AppLayout';
import { router } from '@inertiajs/react';
import { useState } from 'react';

export default function Show({ contenants, source }) {
    // Un seul état pour suivre les items cochés
    const [checkedItems, setCheckedItems] = useState({});

    // Fonction pour cocher/décocher un item
    const toggleItem = (itemId) => {
        setCheckedItems(prev => ({
            ...prev,
            [itemId]: !prev[itemId] // Inverse l'état
        }));
    };

    // Fonction pour vérifier si TOUT est coché
    const isEverythingChecked = () => {
        // Si y'a pas de contenants, on retourne false
        if (!contenants) return false;

        // On vérifie chaque item dans chaque contenant
        for (const contenant of contenants) {
            for (const item of contenant.items) {
                // Si un seul item n'est pas coché, on retourne false
                if (!checkedItems[item.id]) return false;
            }
        }
        // Si on arrive ici, c'est que tout est coché
        return true;
    };

    // Fonction de validation
    const validate = () => {
        if (!isEverythingChecked()) {
            alert("Coche TOUS les éléments avant de valider !");
            return;
        }
        router.post(`/verif/show/validate/${source.id || 1}`);
    };

    return (
        <div className="index-source-page page">
            <h1 className="title-user">Vérification du {source.name}</h1>
            <p className="instruction">Cochez les éléments présents dans chaque contenant</p>

            <div className="contenant-container">
                {contenants?.map((contenant) => (
                    <div key={contenant.id} className="contenant">
                        <h2>{contenant.name}</h2>
                        <div className="items-grid">
                            {contenant.items?.map((item) => (
                                <div key={item.id} className="item">
                                    <label className={`item-label ${checkedItems[item.id] ? 'checked' : ''}`}>
                                        <input
                                            type="checkbox"
                                            onChange={() => toggleItem(item.id)}
                                            checked={checkedItems[item.id] || false}
                                            className="item-checkbox"
                                        />
                                        <span><strong>{item.pivot.qty_affect}</strong> x {item.name}</span>
                                    </label>
                                </div>
                            ))}
                        </div>
                    </div>
                ))}
            </div>

            <button
                onClick={validate}
                className="btn"
            >
                Valider la vérification
            </button>
        </div>
    );
}

Show.layout = page => <AppLayout>{page}</AppLayout>;