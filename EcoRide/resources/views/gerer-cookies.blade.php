@extends('layouts.app')

@section('content')

    <div class="flex flex-col justify-center items-center mt-75 xl:mt-5 gap-10 bg-green4 rounded-3xl p-5 m-5 xl:ml-50 xl:mr-50">

        <h1 class="font-main text-6xl text-green1 uppercase text-shadow-lg">
            Gérer mes cookies
        </h1>

        <form id="cookie-settings-form" class="flex flex-col gap-4">
            <div>
                <input type="checkbox" checked disabled class="mr-2 text-green1 accent-green1 w-8 h-8" />
                <label class="text-4xl font-second">Cookies nécessaires (toujours activés)</label>
            </div>
            <div>
                <input type="checkbox" name="analytics" class="mr-2 text-green1 accent-green1 w-8 h-8" />
                <label class="text-4xl font-second">Cookies de mesure d’audience</label>
            </div>
            <button type="submit" class="uppercase text-4xl tracking-wide text-center font-second border-2 border-black hover:bg-green2 bg-green3 active:bg-green3 rounded-3xl p-2">Enregistrer</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const prefs = JSON.parse(localStorage.getItem('cookiePrefs') || '{}');
            document.querySelector('input[name="analytics"]').checked = prefs.analytics || false;

            document.getElementById('cookie-settings-form').addEventListener('submit', e => {
                e.preventDefault();
                const newPrefs = {
                    necessary: true,
                    analytics: document.querySelector('input[name="analytics"]').checked,
                };
                setCookiePrefs(newPrefs);
                Swal.fire({
                    title: 'Préférences enregistrées !',
                    icon: 'success',
                    showConfirmButton: true,
                    customClass:{
                        popup: 'custom-swal'
                    }
                });
            });
        });
    </script>
@endsection