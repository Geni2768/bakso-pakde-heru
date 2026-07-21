<!DOCTYPE html>
<html lang="id">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Bakso Pakde Heru</title>

@vite(['resources/css/app.css','resources/js/app.js'])

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>


<body class="bg-white">


<div class="max-w-6xl mx-auto shadow min-h-screen">


<!-- NAVBAR -->

<nav class="flex justify-between items-center px-8 py-5">


<div class="flex items-center gap-3">


<img src="{{asset('assets/logo.png')}}"
class="w-14">


<div class="font-bold text-red-600">

Bakso<br>

<span class="text-black italic">
Pakde Heru
</span>

</div>


</div>



<div class="flex gap-8 font-semibold text-sm">


<a href="/" class="text-red-600">
Beranda
</a>


<a href="/pesanan-menu">
Menu
</a>


<a href="/cart">

<i class="fa fa-shopping-cart text-red-600"></i>

@if(session('cart'))
({{count(session('cart'))}})
@endif

</a>


</div>


</nav>





<!-- HERO -->


<section class="bg-orange-50 px-10 py-10 flex items-center">


<div class="w-1/2">


<h1 class="text-5xl font-bold">

Bakso Favorit<br>
keluarga

</h1>



<p class="text-gray-600 text-sm mt-5">

Enak, Murah dan Siap Diantar<br>
Sampai Rumah Anda

</p>



<a href="/pesanan-menu">

<button
class="mt-8 bg-red-600 text-white px-6 py-3 rounded">


<i class="fa fa-shopping-bag mr-2"></i>

Pesanan Saya


</button>

</a>



</div>





<div class="w-1/2 text-center">


<img src="{{asset('assets/bakso.png')}}"
class="w-96 mx-auto">


</div>



</section>







<!-- MENU FAVORIT -->


<section class="px-10 py-8">


<h2 class="font-bold mb-5">

<i class="fa fa-shopping-basket text-red-600"></i>

Menu Favorit

</h2>



<div class="grid grid-cols-3 gap-8">



@foreach($menus as $menu)



<div class="text-center">


<img src="{{asset('storage/'.$menu->gambar)}}"
class="w-24 h-24 rounded-full object-cover mx-auto">



<h3 class="font-bold mt-3">

{{$menu->nama_menu}}

</h3>



<p class="text-red-600">

Rp {{number_format($menu->harga,0,',','.')}}

</p>



<form action="{{route('cart.add',$menu->id)}}"
method="POST">

@csrf


<button
class="bg-red-600 text-white rounded-full w-7 h-7 mt-2">


+

</button>


</form>



</div>



@endforeach



</div>


</section>








<!-- FOOTER -->


<footer class="bg-red-600 text-white px-10 py-6">


<div class="grid grid-cols-3 text-sm">


<div>

<b>Alamat</b>

<p>
Jl. Raya Tangerang<br>
Kota Tangerang
</p>


</div>




<div>

<b>Telepon</b>

<p>

<i class="fa fa-phone"></i>
0812-3812-1676

</p>

</div>





<div class="text-right">


<b>Jam Buka</b>


<p>

07.00 - 17.00 WIB

</p>


</div>


</div>


</footer>


</div>


</body>

</html>
