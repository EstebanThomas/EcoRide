@if (!session('cookie_prefs_set'))
<div id="cookie-banner" class="flex flex-row justify-center items-center gap-4 fixed bottom-0 w-full text-3xl font-second bg-green4 text-black pt-2 pb-2 border-t-1 border-black">
    <div class="flex flex-col md:flex-row justify-between items-center gap-3">
        <p class="text-4xl xl:text-2xl font-second">
            Nous utilisons des cookies pour améliorer votre expérience et mesurer l’audience. 
            <a href="{{ route('politique.cookies') }}" class="underline">En savoir plus</a>.
        </p>
        <div class="flex gap-2">
            <button onclick="acceptCookies()" 
            class="bg-green1 hover:bg-green3 active:bg-green1 border border-black rounded-3xl xl:text-2xl font-second text-black text-center p-3 pt-1 pb-1 uppercase">Tout accepter</button>
            <button onclick="refuseCookies()" 
            class="bg-red-500 hover:bg-red-400 active:bg-red-500 border border-black rounded-3xl xl:text-2xl font-second text-black text-center p-3 pt-1 pb-1 uppercase">Tout refuser</button>
            <a href="{{ route('gerer.cookies') }}" 
            class="bg-white hover:bg-gray-300 active:bg-white border border-black rounded-3xl xl:text-2xl font-second text-black text-center p-3 pt-1 pb-1 uppercase items-center flex">Personnaliser</a>
        </div>
    </div>
</div>
@endif

<script>
    function setCookiePrefs(prefs) {
        localStorage.setItem('cookiePrefs', JSON.stringify(prefs));
        fetch("{{ route('cookies.store') }}", {
            method: "POST",
            headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
            },
            body: JSON.stringify({ prefs })
        }).then(() => {
            document.getElementById('cookie-banner').remove();
        });
    }

    function acceptCookies() {
        setCookiePrefs({
            necessary: true,
            analytics: false
        });
    }

    function refuseCookies() {
        setCookiePrefs({
            necessary: true,
            analytics: true
        });
    }
</script>