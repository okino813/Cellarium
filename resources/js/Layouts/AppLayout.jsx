import { Link, usePage, router } from '@inertiajs/react'
import React from 'react'
import { useState } from 'react'

function TopBar() {
    const { session } = usePage().props
    const [overlayOpen, setOverlayOpen] = useState(false)

    return (
        <div className="nav-container">
            <div>
                <p>Bonjour, {session.firstname} {session.lastname} !</p>
            </div>
            <div className="nav-links">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"
                         onClick={() => setOverlayOpen(!overlayOpen)}
                         style={{ fill: 'white', cursor: 'pointer' }}>
                        <path d="M240 192C240 147.8 275.8 112 320 112C364.2 112 400 147.8 400 192C400 236.2 364.2 272 320 272C275.8 272 240 236.2 240 192zM448 192C448 121.3 390.7 64 320 64C249.3 64 192 121.3 192 192C192 262.7 249.3 320 320 320C390.7 320 448 262.7 448 192zM144 544C144 473.3 201.3 416 272 416L368 416C438.7 416 496 473.3 496 544L496 552C496 565.3 506.7 576 520 576C533.3 576 544 565.3 544 552L544 544C544 446.8 465.2 368 368 368L272 368C174.8 368 96 446.8 96 544L96 552C96 565.3 106.7 576 120 576C133.3 576 144 565.3 144 552L144 544z"/>
                    </svg>


                <div className={`overlay-action-user ${overlayOpen ? 'visible' : ''}`}>
                    {(session.isAdmin || session.isAdminChief) && (

                        <div>
                        <a href="/change-mode" onClick={(e) => {
                            e.preventDefault()
                            setOverlayOpen(false)
                            router.visit('/change-mode', { preserveState: false })
                        }}>
                            {session.mode === 'user' ? 'Passer en mode Admin' : 'Passer en mode Utili.'}
                        </a>
                        <hr />
                        </div>
                    )}
                    <a href="/logout">Déconnexion</a>
                </div>
                </div>
        </div>
    )
}

function BottomNav() {
    const { session } = usePage().props
    if (session.mode === 'admin') {
        return (
            <nav>
                <div className="footer_menu">
                    <div className="link_list">
                        <div className="check-engin">
                            <Link href="/admin">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M277.8 8.6c-12.3-11.4-31.3-11.4-43.5 0l-224 208c-9.6 9-12.8 22.9-8 35.1S18.8 272 32 272l16 0 0 176c0 35.3 28.7 64 64 64l288 0c35.3 0 64-28.7 64-64l0-176 16 0c13.2 0 25-8.1 29.8-20.3s1.6-26.2-8-35.1l-224-208zM240 320l32 0c26.5 0 48 21.5 48 48l0 96-128 0 0-96c0-26.5 21.5-48 48-48z"/></svg>
                                <p>Accueil</p>
                            </Link>
                        </div>
                        <div className="check-engin">
                            <Link href="/admin/mouvement/index">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.6 150.6l-96 96c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L402.7 160 32 160c-17.7 0-32-14.3-32-32S14.3 96 32 96l370.7 0-41.4-41.4c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l96 96c12.5 12.5 12.5 32.8 0 45.3zm-397.3 352l-96-96c-12.5-12.5-12.5-32.8 0-45.3l96-96c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3L109.3 352 480 352c17.7 0 32 14.3 32 32s-14.3 32-32 32l-370.7 0 41.4 41.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0z"/></svg>
                                <p>Mouvements</p></Link>
                        </div>
                        <div className="check-engin">
                            <Link href="/admin/items">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M96 112c0-26.5 21.5-48 48-48s48 21.5 48 48l0 112-96 0 0-112zm-64 0l0 288c0 61.9 50.1 112 112 112s112-50.1 112-112l0-105.8 116.3 169.5c35.5 51.7 105.3 64.3 156 28.1s63-107.5 27.5-159.2L427.3 145.3c-35.5-51.7-105.3-64.3-156-28.1-5.6 4-10.7 8.4-15.3 13.1l0-18.3C256 50.1 205.9 0 144 0S32 50.1 32 112zM296.6 240.2c-16-23.3-10-55.3 11.9-71 21.2-15.1 50.5-10.3 66 12.2l67 97.6-79.9 55.9-65-94.8z"/></svg>
                                <p>Items</p></Link>
                        </div>
                        <div className="check-engin">
                            <Link href="/admin/containings">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M200 48l112 0c4.4 0 8 3.6 8 8l0 40-128 0 0-40c0-4.4 3.6-8 8-8zm-56 8l0 40-80 0C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-80 0 0-40c0-30.9-25.1-56-56-56L200 0c-30.9 0-56 25.1-56 56zm80 160c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 40 40 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-40 0 0 40c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-40-40 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16l40 0 0-40z"/></svg>
                                <p>Contenants</p></Link>
                        </div>
                        <div className="check-engin">
                            <Link href="/admin/sources">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M64 32C28.7 32 0 60.7 0 96L0 384c0 35.3 28.7 64 64 64l3.3 0c10.4 36.9 44.4 64 84.7 64s74.2-27.1 84.7-64l102.6 0c10.4 36.9 44.4 64 84.7 64s74.2-27.1 84.7-64l3.3 0c35.3 0 64-28.7 64-64l0-146.7c0-17-6.7-33.3-18.7-45.3L512 146.7c-12-12-28.3-18.7-45.3-18.7l-50.7 0 0-32c0-35.3-28.7-64-64-64L64 32zM512 237.3l0 50.7-96 0 0-96 50.7 0 45.3 45.3zM152 384a40 40 0 1 1 0 80 40 40 0 1 1 0-80zm232 40a40 40 0 1 1 80 0 40 40 0 1 1 -80 0zM176 136c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 40 40 0c8.8 0 16 7.2 16 16l0 32c0 8.8-7.2 16-16 16l-40 0 0 40c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-40-40 0c-8.8 0-16-7.2-16-16l0-32c0-8.8 7.2-16 16-16l40 0 0-40z"/></svg>
                                <p>Source</p></Link>
                        </div>
                        <div className="check-engin">
                            <Link href="/admin/users">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 248a120 120 0 1 0 0-240 120 120 0 1 0 0 240zm-29.7 56C95.8 304 16 383.8 16 482.3 16 498.7 29.3 512 45.7 512l356.6 0c16.4 0 29.7-13.3 29.7-29.7 0-98.5-79.8-178.3-178.3-178.3l-59.4 0z"/></svg>
                                <p>Utilisateurs</p></Link>
                        </div>
                    </div>
                </div>
            </nav>
        )
    }
    return (
        <nav>
            <div className="footer_menu">
                <div className="link_list">
                    <div className="check-engin">
                        <Link href="/return-inter">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M240 24c0-13.3 10.7-24 24-24l48 0c13.3 0 24 10.7 24 24l0 56 56 0c13.3 0 24 10.7 24 24l0 48c0 13.3-10.7 24-24 24l-56 0 0 56c0 13.3-10.7 24-24 24l-48 0c-13.3 0-24-10.7-24-24l0-56-56 0c-13.3 0-24-10.7-24-24l0-48c0-13.3 10.7-24 24-24l56 0 0-56zM66.7 384l42.5-42.5c24-24 56.6-37.5 90.5-37.5L352 304c17.7 0 32 14.3 32 32s-14.3 32-32 32l-72 0c-13.3 0-24 10.7-24 24s10.7 24 24 24l112.6 0 119.7-88.2c17.8-13.1 42.8-9.3 55.9 8.5s9.3 42.8-8.5 55.9L433.1 485.5c-23.4 17.2-51.6 26.5-80.7 26.5L32 512c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l34.7 0z"/></svg>
                            <p>Retour d'intervention</p></Link>
                    </div>
                    <div className="check-engin">
                        <Link href="/verif">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M133.8 36.3c10.9 7.6 13.5 22.6 5.9 33.4l-56 80c-4.1 5.8-10.5 9.5-17.6 10.1S52 158 47 153L7 113C-2.3 103.6-2.3 88.4 7 79S31.6 69.7 41 79l19.8 19.8 39.6-56.6c7.6-10.9 22.6-13.5 33.4-5.9zm0 160c10.9 7.6 13.5 22.6 5.9 33.4l-56 80c-4.1 5.8-10.5 9.5-17.6 10.1S52 318 47 313L7 273c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l19.8 19.8 39.6-56.6c7.6-10.9 22.6-13.5 33.4-5.9zM224 96c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32l224 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-224 0c-17.7 0-32-14.3-32-32zM160 416c0-17.7 14.3-32 32-32l288 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-288 0c-17.7 0-32-14.3-32-32zM64 376a40 40 0 1 1 0 80 40 40 0 1 1 0-80z"/></svg>
                            <p>Vérification des engins</p></Link>
                    </div>
                </div>
            </div>
        </nav>
    )
}

export default function AppLayout({ children }) {
    return (
        <div className="app-shell">
            <TopBar />
            <main className="app-content">
                {children}
            </main>
            <BottomNav />
        </div>
    )
}
