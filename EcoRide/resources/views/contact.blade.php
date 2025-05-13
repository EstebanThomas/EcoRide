@extends('layouts.app')

@section('content')
    
    <div class="mt-75 xl:mt-5 flex flex-col justify-center items-center gap-3 ">
        <h1 class="font-main text-6xl text-green1 uppercase text-shadow-lg">Contact</h1>

        <form method="POST" action="{{ route('contact.send') }}" class="flex flex-col justify-center items-center gap-5 bg-green4 rounded-3xl w-200 p-5 m-5 xl:ml-50 xl:mr-50">

            @csrf

            <div>
                <label class="font-second text-3xl">Nom :</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-150 border p-2 font-second text-3xl" required>
                @error('name') <p class="text-red-500 font-second text-3xl">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="font-second text-3xl">Email :</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-150 border p-2 font-second text-3xl" required>
                @error('email') <p class="text-red-500 font-second text-3xl">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="font-second text-3xl">Message :</label>
                <textarea name="message" rows="5" class="w-180 border p-2 font-second text-3xl" required>{{ old('message') }}</textarea>
                @error('message') <p class="text-red-500 font-second text-3xl">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-green1 hover:bg-green2 active:bg-green1 text-black border border-black text-center rounded-3xl font-second text-3xl p-8 pt-1 pb-1">Envoyer</button>
        </form>
    </div>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Message envoyé !',
                    icon: 'success',
                    showConfirmButton: true,
                    customClass:{
                        popup: 'custom-swal'
                    }
                });
            })
        </script>
    @elseif(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Erreur !',
                    text: @json(session('error')),
                    icon: 'error',
                    showConfirmButton: true,
                    customClass:{
                        popup: 'custom-swal'
                    }
                });
            })
        </script>
    @endif

@endsection