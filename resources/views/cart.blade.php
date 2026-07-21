<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Keranjang - Bakso Pakde Heru</title>

@vite(['resources/css/app.css','resources/js/app.js'])

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>


<body class="bg-orange-50">


<div class="max-w-5xl mx-auto bg-white min-h-screen shadow">


<!-- HEADER -->

<div class="flex justify-between items-center px-8 py-5">


<div class="font-bold text-red-600 text-xl">

Bakso<br>

<span class="text-black italic">
Pakde Heru
</span>

</div>



<a href="/"
class="text-sm font-semibold">

<i class="fa fa-arrow-left"></i>
Kembali

</a>


</div>





<!-- CONTENT -->


<div class="px-8 py-5">


<h1 class="text-2xl font-bold mb-6">

<i class="fa fa-shopping-cart text-red-600"></i>

Keranjang Saya

</h1>





@if(count($cart) == 0)


<div class="text-center py-10">


<i class="fa fa-cart-shopping text-5xl text-gray-300"></i>


<p class="mt-3 text-gray-500">

Keranjang masih kosong

</p>


<a href="/pesanan-menu">


<button class="mt-5 bg-red-600 text-white px-5 py-2 rounded">

Pilih Menu

</button>


</a>


</div>



@else




@php

$total = 0;

@endphp



@foreach($cart as $id=>$item)



<div class="flex items-center justify-between border-b py-4">


<div class="flex items-center gap-4">


<img src="{{asset('storage/'.$item['gambar'])}}"
class="w-20 h-20 rounded-full object-cover">


<div>


<h3 class="font-bold">

{{$item['nama']}}

</h3>


<p class="text-gray-500">

{{$item['qty']}} x 
Rp {{number_format($item['harga'],0,',','.')}}

</p>


</div>


</div>





<div class="text-right">


<p class="font-bold text-red-600">

Rp {{number_format($item['harga']*$item['qty'],0,',','.')}}

</p>



<form action="{{route('cart.delete',$id)}}"
method="POST">


@csrf

@method('DELETE')


<button class="text-sm text-red-600 mt-2">

<i class="fa fa-trash"></i>

Hapus

</button>


</form>


</div>



</div>



@php

$total += $item['harga']*$item['qty'];

@endphp



@endforeach






<div class="mt-8 bg-orange-50 rounded-lg p-5">


<div class="flex justify-between text-lg font-bold">


<span>

Total Pembayaran

</span>


<span class="text-red-600">

Rp {{number_format($total,0,',','.')}}

</span>


</div>



<button
class="w-full mt-5 bg-red-600 text-white py-3 rounded-lg font-bold">


<i class="fa fa-check"></i>

Checkout


</button>



</div>




@endif



</div>




<!-- FOOTER -->


<footer class="bg-red-600 text-white px-8 py-5 mt-10">


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
