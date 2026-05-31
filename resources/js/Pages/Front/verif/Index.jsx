import AppLayout from '@/Layouts/AppLayout'
import { useForm, usePage, Link } from '@inertiajs/react'
import { useState } from 'react'

export default function Index({ sources, success }) {

    if(success){
        alert("GG !")
    }
    return (
        <div>
            <div className="index-source-page page">
                <h1 className="title-user">Vérification</h1>
                <p className="instruction">Choisissez la source à vérifié</p>
                <div className="sources-grid" id="sources-container">
                    {sources.map( source =>{
                        return (
                            <Link href={"/verif/show/"+source.id} className="source">
                                <h2>{source.name}</h2>
                            </Link>
                        )
                    })}
                </div>
            </div>
        </div>
        )
}

Index.layout = page => <AppLayout>{page}</AppLayout>
