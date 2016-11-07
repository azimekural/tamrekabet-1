
@extends('layouts.app2')
<br>
 <br>
 @section('content')
 <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
 <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #fff;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #fff;
}
.div5{
    float:right;
}
.div6{
    float:left;
}
.button {
    background-color: #ccc; /* Green */
    border: none;
    color: white;
    padding: 6px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
}



</style>
     <div class="container">
         <nav class="navbar navbar-inverse">
             <div class="container-fluid">
                 <div class="navbar-header">
                     <a class="navbar-brand" href="#"><img src='{{asset('images/anasayfa.png')}}'></a>
                 </div>
                 <ul class="nav navbar-nav">
                     <li class=""><a href="{{ url('firmaProfili/'.$firma->id)}}">Firma Profili</a></li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">İlan İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="{{ url('ilanlarim/'.$firma->id) }}">İlanlarım</a></li>
                             <li><a href="{{ url('firmaIlanOlustur/ilanEkle/'.$firma->id) }}">İlan Oluştur</a></li>
                         </ul>
                     </li>
                     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Başvuru İşlemleri <span class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="#">Başvurularım</a></li>
                             <li><a href="#">Başvur</a></li>
                         </ul>
                     </li>
                     <li><a href="#">Mesajlar</a></li>
                     <li><a href="#">Kullanici İşlemleri</a></li>
                 </ul>
             </div>
         </nav>
         <div class="panel-header">
             <h3><strong>{{$firma->adi}}</strong> firmasının <strong>{{$ilan->adi}}</strong> ilanının Teklifleri </h3>
         </div>
         
         <div class="panel-body">
             <table class="table" id="myTable">
                 <thead>
                    <th>Sıra</th>
                    <th>Firma Adı</th>
                    <th>Kalem</th>
                    <th>Toplam Fiyat</th>
                    <th>Para Birimi</th>
                    <th></th>
                 </thead>
                 <tbody>
                     <?php $i=1;
                     ?>
                     @foreach($ilan->teklifler as $teklif)
                        <?php  $teklifHareket = $teklif->teklif_hareketler()->groupBy('firma_kullanicilar_id')->where('teklif_id',$teklif->id)->get();
                          $birFirmayaAitTeklifler = $teklif->teklif_hareketler()->
                                             
                                              groupBY('teklif_id');
                        ?>
                            @foreach($teklifHareket as $teklifhareket)
                            <?php  $kullanici = DB::table('firma_kullanicilar')
                                    ->where('firma_kullanicilar.id',$teklifhareket->firma_kullanicilar_id)
                                    ->join('kullanicilar', 'firma_kullanicilar.kullanici_id', '=', 'kullanicilar.id')
                                    ->first();
                                    $birFirmayaAitTeklifler->where('firma_kullanicilar_id',$teklifhareket->firma_kullanicilar)->get();
                           ?>
                            <tr>
                                <td>{{$i}}</td>
                                <td><a href="#" id="trigger{{$i}}">{{$kullanici->adi}}</a></td>
                                <td></td>
                                <td>{{$teklifhareket->kdv_dahil_fiyat}}</td>
                                <td>{{$teklifhareket->para_birimleri->adi}}</td>
                                <td><a href="#" class="trigger">Detayları Gör</a>
                                    <div class="pop-up" style="display: none;
                                        position: absolute;
                                        width: 280px;
                                        padding: 10px;
                                        background: #eeeeee;
                                        color: #000000;
                                        border: 1px solid #1a1a1a;
                                        font-size: 90%">
                                      <h3>{{$ilan->adi}}</h3>
                                      <p>
                                        Kdv dahil fiyat {{$teklifhareket->kdv_dahil_fiyat}}
                                        Kdv hariç fiyat {{$teklifhareket->kdv_haric_fiyat}}
                                      </p>
                                      <h5>Daha önce verilen teklifler</h5>
                                        
                                         
                                    </div>
                                </td>
                            </tr>
                           
                            {{$i++}}
                        @endforeach

                     @endforeach
                 </tbody>
             </table>
         </div>
    </div>
@endsection
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>


<script>
$(document).ready(function(){
    
    var table =$('#myTable').dataTable({
       "language": {
            "sDecimal":        ",",
            "sEmptyTable":     "Tabloda herhangi bir veri mevcut değil",
            "sInfo":           "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
            "sInfoEmpty":      "Kayıt yok",
            "sInfoFiltered":   "(_MAX_ kayıt içerisinden bulunan)",
            "sInfoPostFix":    "",
            "sInfoThousands":  ".",
            "sLengthMenu":     "Sayfada _MENU_ kayıt göster",
            "sLoadingRecords": "Yükleniyor...",
            "sProcessing":     "İşleniyor...",
            "sSearch":         "Ara:",
            "sZeroRecords":    "Eşleşen kayıt bulunamadı",
            "oPaginate": {
                "sFirst":    "İlk",
                "sLast":     "Son",
                "sNext":     "Sonraki",
                "sPrevious": "Önceki"
            },
            "oAria": {
                "sSortAscending":  ": artan sütun sıralamasını aktifleştir",
                "sSortDescending": ": azalan sütun soralamasını aktifleştir"
            }
        }
    });
    $(function () {
        $('a.trigger').mouseover(function () {
            $(this).parent().children().show();
        });
        $('a.trigger').mouseleave(function () {
            $('div.pop-up').hide();
        });
    });
});

  
</script>
<script src="http://cdn.datatables.net/plug-ins/1.10.12/sorting/turkish-string.js"></script>