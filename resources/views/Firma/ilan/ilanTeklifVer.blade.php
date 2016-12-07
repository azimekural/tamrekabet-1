
@extends('layouts.app')
<br>
 <br>
 @section('content')
 
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
         <?php $firma=$ilan->firmalar;?>
          @include('layouts.alt_menu') 
         <div class="col-sm-12">     
             
            <h3>{{$firma->adi}}'nın {{$ilan->adi}} İlanına Teklif  Ver</h3>
              <hr>
              <div class="panel-group" id="accordion">
                  <div id="mal"   class="panel panel-default">
                      <div class="panel-heading">
                          <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Fiyat İstenen Kalemler Listesi</a>
                          </h4>
                      </div>
                      <div id="collapse4" class="panel-collapse collapse">
                          <div class="panel-body">
                                <?php $firma_id = session()->get('firma_id'); 
                                    $kullanici_id=Auth::user()->kullanici_id;
                              ?>
                              {{ Form::open(array('url'=>'teklifGonder/'.$firma_id .'/'.$ilan->id.'/'.$kullanici_id,'method' => 'POST', 'files'=>true)) }}  
                              <table class="table" >
                                  <thead id="tasks-list" name="tasks-list">
                                      <tr id="firma{{$firma->id}}">
                                          <?php
                                          if (!$firma->ilanlar)
                                              $firma->ilanlar = new App\Ilan();
                                          if (!$firma->ilanlar->ilan_mallar)
                                              $firma->ilanlar->ilan_mallar = new App\IlanMal();
                                        $i=0;  
                                          ?>
                                      <tr>
                                          <th>Sıra:</th>
                                          <th>Marka:</th>
                                          <th>Model:</th>
                                          <th>Adı:</th>
                                          <th>Ambalaj:</th>
                                          <th>Miktar:</th>
                                          <th>Birim:</th>
                                          <th>KDV Oranı:</th>
                                          <th>Birim Fiyat:</th>
                                          <th>Para Birimi</th>
                                          <th>Toplam:</th>

                                      </tr>
                                       
                                      @foreach($ilan->ilan_mallar as $ilan_mal)
                                      <tr id="{{$ilan_mal->id}}tr">
                                          <td>
                                              {{$ilan_mal->sira}}
                                          </td>
                                          <td>
                                              {{$ilan_mal->marka}}
                                          </td>
                                          <td>
                                              {{$ilan_mal->model}}
                                          </td>
                                          <td>
                                              {{$ilan_mal->adi}}
                                          </td>
                                          <td>
                                              {{$ilan_mal->ambalaj}}
                                          </td>
                                          <td>
                                              {{$ilan_mal->miktar}}
                                          </td>
                                          <td>
                                              {{$ilan_mal->birimler->adi}}
                                          </td>
                                          
                                          <td>
                                              <select class="form-control select" name="kdv[]" id="kdv" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 <option  value="0" >%0</option>
                                                                 <option  value="1" >%1</option>
                                                                 <option  value="8" >%8</option>
                                                                 <option  value="18">%18</option>                                                               
                                             </select>
                                          </td>
                                          <td>
                                            <input type="text" class="form-control fiyat" id="fiyat" name="{{$ilan_mal->id}}" placeholder="Fiyat" value="" required>
                                          </td>
                                          <td>
                                              {{$firma->ilanlar->para_birimleri->adi}}
                                          </td>
                                          <td>
                                               <label for="inputEmail3"  id="{{$ilan_mal->id}}"  name ="fiyat" class="col-sm-3 control-label toplam"></label>
                                               <input type="hidden" name="fiyat[]"  id="{{$ilan_mal->id}}" value="">
                                          </td>
                                           <?php $i++;?>                                          
                                          <input type="hidden" name="ilan_mal_id[]"  id="ilan_mal_id" value="{{$ilan_mal->id}}"> 
                                        </tr>
                                        @endforeach
                                        <tr>
                                          <td colspan="10">
                                            <label for="toplamFiyatLabel" id="toplamFiyatLabel" class="col-sm-3 control-label toplam"></label>  
                                          </td>
                                          <td>
                                              <label for="inputEmail3" name="toplamFiyatL" id="toplamFiyatL" class="col-sm-3 control-label toplam"></label>
                                              <input type="hidden" name="toplamFiyat"  id="toplamFiyat" value="">
                                          </td>
                                        </tr>
                                        </tbody>
                              </table>
                            <?php $firma_id = session()->get('firma_id'); 
                                    $kullanici_id=Auth::user()->kullanici_id;
                              ?>
                                {!! Form::submit('Teklif Gönder', array('url'=>'teklifGonder/'.$firma_id.'/'.$ilan->id.'/'.$kullanici_id,'class'=>'btn btn-danger')) !!}
                                {!! Form::close() !!}
                            </div>
                      </div>
                  </div>
                  <div  id="hizmet"   class="panel panel-default">
                      <div class="panel-heading">
                          <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Fiyat İstenen Kalemler Listesi</a>
                          </h4>
                      </div>
                      <div id="collapse5" class="panel-collapse collapse">
                          <div class="panel-body"> <?php $firma_id = session()->get('firma_id'); 
                                    $kullanici_id=Auth::user()->kullanici_id;
                              ?>
                              {{ Form::open(array('url'=>'teklifGonder/'.$firma_id .'/'.$ilan->id.'/'.$kullanici_id,'method' => 'POST', 'files'=>true)) }}
                              <table class="table" >
                                  <thead id="tasks-list" name="tasks-list">
                                      <tr id="firma{{$firma->id}}">
                                          <?php
                                          if (!$firma->ilanlar)
                                              $firma->ilanlar = new App\Ilan();
                                          if (!$firma->ilanlar->ilan_hizmetler)
                                              $firma->ilanlar->ilan_hizmetler = new App\IlanHizmet();
                                   
                                          ?>
                                      <tr>
                                          <th>Sıra:</th>
                                          <th>Adı:</th>
                                          <th>Fiyat Standartı:</th>
                                          <th>Fiyat Standartı Birimi:</th>
                                          <th>Miktar:</th>
                                          <th>Miktar Birimi:</th>
                                           <th>KDV Oranı:</th>
                                          <th>Birim Fiyat:</th>
                                          <th>Para Birimi</th>
                                           <th>Toplam:</th>
                                      </tr>
                                      @foreach($firma->ilanlar->ilan_hizmetler as $ilan_hizmet)
                                      <tr>
                                          <td>
                                              {{$ilan_hizmet->sira}}
                                          </td>

                                          <td>
                                              {{$ilan_hizmet->adi}}
                                          </td>
                                          <td>
                                              {{$ilan_hizmet->fiyat_standardi}}
                                          </td>
                                          <td>
                                              {{$ilan_hizmet->fiyat_birimler->adi}}
                                          </td>
                                          <td>
                                              {{$ilan_hizmet->miktar}}
                                          </td>
                                          <td>
                                              {{$ilan_hizmet->miktar_birimler->adi}}
                                          </td>
                                            <td>
                                              <select class="form-control select" name="kdv[]" id="kdv" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 <option  value="0" >%0</option>
                                                                 <option  value="1" >%1</option>
                                                                 <option  value="8" >%8</option>
                                                                 <option  value="18">%18</option>                                                                
                                             </select>
                                          </td>
                                          <td>
                                            <input type="text" class="form-control fiyat" id="fiyat" name="{{$ilan_hizmet->id}}" placeholder="Fiyat" value="" required>
                                          </td>
                                          <td>
                                              {{$firma->ilanlar->para_birimleri->adi}}
                                          </td>
                                          <td>
                                               <label for="inputEmail3"  id="{{$ilan_hizmet->id}}"  name ="fiyat" class="col-sm-3 control-label toplam"></label>
                                               <input type="hidden" name="fiyat[]"  id="{{$ilan_hizmet->id}}" value="">
                                          </td>
                                           <?php $i++;?>                                          
                                          <input type="hidden" name="ilan_hizmet_id[]"  id="ilan_hizmet_id" value="{{$ilan_hizmet->id}}"> 
                                        </tr>
                                        @endforeach
                                        <tr>
                                          <td colspan="9">
                                            <label for='toplamFiyatLabel' id="toplamFiyatLabel" class="col-sm-3 control-label toplam"></label>  
                                          </td>
                                          <td>
                                              <label for="toplamFiyatL" id="toplamFiyatL" class="col-sm-3 control-label toplam"></label>
                                              <input type="hidden" name="toplamFiyat"  id="toplamFiyat" value="">
                                          </td>
                                        </tr>
                                        </tbody>
                              </table>
                              
                                {!! Form::submit('Teklif Gönder', array('url'=>'teklifGonder/'.$firma_id .'/'.$ilan->id.'/'.$kullanici_id,'class'=>'btn btn-danger')) !!}
                                {!! Form::close() !!}        
                          </div>
                      </div>
                  </div>
                  <div  id="goturu" class="panel panel-default ">
                      <div class="panel-heading">
                          <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Fiyat İstenen Kalemler Listesi</a>
                          </h4>
                      </div>
                      <div id="collapse6" class="panel-collapse collapse">
                          <div class="panel-body"> <?php $firma_id = session()->get('firma_id'); 
                                    $kullanici_id=Auth::user()->kullanici_id;
                              ?>
                              {{ Form::open(array('url'=>'teklifGonder/'.$firma_id .'/'.$ilan->id.'/'.$kullanici_id,'method' => 'POST', 'files'=>true)) }}
                              <table class="table" >
                                  <thead id="tasks-list" name="tasks-list">
                                      <tr id="firma{{$firma->id}}">
                                          <?php
                                          if (!$firma->ilanlar)
                                              $firma->ilanlar = new App\Ilan();
                                          if (!$firma->ilanlar->ilan_goturu_bedeller)
                                              $firma->ilanlar->ilan_goturu_bedeller = new App\IlanGoturuBedel ();                                     
                                          ?>
                                      <tr>
                                          <th>Sıra:</th>
                                          <th>İşin Adı:</th>
                                          <th>Miktar Türü:</th>
                                          <th>KDV Oranı:</th>
                                          <th>Fiyat:</th>
                                          <th>Para Birimi</th>
                                          <th>Toplam:</th>
                                      </tr>
                                      @foreach($firma->ilanlar->ilan_goturu_bedeller as $ilan_goturu_bedel)
                                      <tr>
                                          <td>
                                              {{$ilan_goturu_bedel->sira}}
                                          </td>

                                          <td>
                                              {{$ilan_goturu_bedel->isin_adi}}
                                          </td>
                                          <td>
                                              {{$ilan_goturu_bedel->miktar_turu}}
                                          </td>
                                             <td>
                                              <select class="form-control select" name="kdv[]" id="kdv" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 <option  value="0" >%0</option>
                                                                 <option  value="1" >%1</option>
                                                                 <option  value="8" >%8</option>
                                                                 <option  value="18">%18</option>                                                                
                                             </select>
                                          </td>
                                          <td>
                                            <input type="text" class="form-control fiyat" id="fiyat" name="{{$ilan_goturu_bedel->id}}" placeholder="Fiyat" value="" required>
                                          </td>
                                          <td>
                                              {{$firma->ilanlar->para_birimleri->adi}}
                                          </td>
                                          <td>
                                               <label for="inputEmail3"  id="{{$ilan_goturu_bedel->id}}"  name ="fiyat" class="col-sm-3 control-label toplam"></label>
                                               <input type="hidden" name="fiyat[]"  id="{{$ilan_goturu_bedel->id}}" value="">
                                          </td>
                                           <?php $i++;?>                                          
                                          <input type="hidden" name="ilan_goturu_bedel_id[]"  id="ilan_goturu_bedel_id" value="{{$ilan_goturu_bedel->id}}"> 
                                        </tr>
                                        @endforeach
                                        <tr>
                                          <td colspan="9">
                                            <label for="inputEmail3" name="toplamFiyatLabel" id="toplamFiyatLabel" class="col-sm-3 control-label toplam"></label>  
                                          </td>
                                          <td>
                                              <label for="inputEmail3" name="toplamFiyatL" id="toplamFiyatL" class="col-sm-3 control-label toplam"></label>
                                              <input type="hidden" name="toplamFiyat"  id="toplamFiyat" value="">
                                          </td>
                                        </tr>
                                        </tbody>
                              </table>
                             
                                {!! Form::submit('Teklif Gönder', array('url'=>'teklifGonder/'.$firma_id .'/'.$ilan->id.'/'.$kullanici_id,'class'=>'btn btn-danger')) !!}
                                {!! Form::close() !!}                         
                          </div>
                      </div>
                  </div>
                  <div id="yapim"  class="panel panel-default ">
                      <div class="panel-heading">
                          <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">Fiyat İstenen Kalemler Listesi</a>
                          </h4>
                      </div>
                      <div id="collapse7" class="panel-collapse collapse">
                          <div class="panel-body">
                              <?php $firma_id = session()->get('firma_id'); 
                                    $kullanici_id=Auth::user()->kullanici_id;
                              ?>
                              {{ Form::open(array('url'=>'teklifGonder/'.$firma_id .'/'.$ilan->id.'/'.$kullanici_id,'method' => 'POST', 'files'=>true)) }}
                              <table class="table" >
                                  <thead id="tasks-list" name="tasks-list">
                                      <tr id="firma{{$firma->id}}">
                                          <?php
                                          if (!$firma->ilanlar)
                                              $firma->ilanlar = new App\Ilan();
                                          if (!$firma->ilanlar->ilan_yapim_isleri)
                                              $firma->ilanlar->ilan_yapim_isleri = new App\IlanYapimIsi();
                                        
                                          ?>
                                      <tr>
                                          <th>Sıra:</th>
                                          <th>Adı:</th>
                                          <th>Miktar:</th>
                                          <th>Birim:</th>
                                          <th>KDV Oranı:</th>
                                          <th>Birim Fiyat:</th>
                                          <th>Para Birimi</th>
                                          <th>Toplam:</th>
                                      </tr>
                                      @foreach($firma->ilanlar->ilan_yapim_isleri as $ilan_yapim_isi)
                                      <tr>
                                          <td>
                                              {{$ilan_yapim_isi->sira}}
                                          </td>

                                          <td>
                                              {{$ilan_yapim_isi->adi}}
                                          </td>
                                          <td>
                                              {{$ilan_yapim_isi->miktar}}
                                          </td>
                                          <td>
                                              {{$ilan_yapim_isi->birimler->adi}}
                                          </td>
                                           <td>
                                              <select class="form-control select" name="kdv[]" id="kdv" required>
                                                                 <option selected disabled>Seçiniz</option>
                                                                 <option  value="0" >%0</option>
                                                                 <option  value="1" >%1</option>
                                                                 <option  value="8" >%8</option>
                                                                 <option  value="18">%18</option>                                                                
                                             </select>
                                          </td>
                                          <td>
                                            <input type="text" class="form-control fiyat" id="fiyat" name="{{$ilan_yapim_isi->id}}" placeholder="Fiyat" value="" required>
                                          </td>
                                          <td>
                                              {{$firma->ilanlar->para_birimleri->adi}}
                                          </td>
                                          <td>
                                               <label for="inputEmail3"  id="{{$ilan_yapim_isi->id}}"  name ="fiyat" class="col-sm-3 control-label toplam"></label>
                                               <input type="hidden" name="fiyat[]"  id="{{$ilan_yapim_isi->id}}" value="">
                                          </td>
                                           <?php $i++;?>                                          
                                          <input type="hidden" name="ilan_yapim_isi_id[]"  id="ilan_yapim_isi_id" value="{{$ilan_yapim_isi->id}}"> 
                                        </tr>
                                        @endforeach
                                        <tr>
                                          <td colspan="10">
                                            <label for="inputEmail3" name="toplamFiyatLabel" id="toplamFiyatLabel" class="col-sm-3 control-label toplam"></label>  
                                          </td>
                                          <td>
                                              <label for="inputEmail3" name="toplamFiyatL" id="toplamFiyatL" class="col-sm-3 control-label toplam"></label>
                                              <input type="hidden" name="toplamFiyat"  id="toplamFiyat" value="">
                                          </td>
                                        </tr>
                                        </tbody>
                              </table>
                              
                                {!! Form::submit('Teklif Gönder', array('url'=>'teklifGonder/'.$firma_id.'/'.$ilan->id.'/'.$kullanici_id,'class'=>'btn btn-danger teklifGonder')) !!}
                                {!! Form::close() !!}                         
                          </div>
                      </div>
                  </div>
              </div>
              <?php $j=0;$k=0;
                $kullanici = App\Kullanici::find(Auth::user()->kullanici_id);
            ?>
            <div class="modal fade" id="myModalSirketListe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                         <h4 class="modal-title" id="myModalLabel">Lütfen Şirket Seçiniz!</h4>
                    </div>
                    <div class="modal-body">
                        <p style="font-weight:bold;text-align: center;font-size:x-large">{{ Auth::user()->name }}  </p>
                        <hr>
                        <div id="radioDiv">
                        @foreach($kullanici->firmalar as $kullanicifirma)
                        <input type="radio" name="firmaSec" value="{{$kullanicifirma->id}}"> {{$kullanicifirma->adi}}<br>   
                        @endforeach
                        </div>
                        <button  style='float:right' type='button' class="firmaButton" class='btn btn-info'>Firma Seçiniz</button><br><br>
                    </div>
                    <div class="modal-footer">                                                            
                    </div>
                 </div>
                </div>
            </div>
              
              
              
              
              <br>
              <br>                                     
             <hr>                               
        </div>    
    </div>
<script>
    var fiyat;
    var temp=0;
    var count=0;
    var toplamFiyat=0; 

 $('.kdv').on('change', function() {
                
    var kdv=parseFloat(this.value);
    var result;
       
    if($(this).parent().next().children().val() !== '')
    {
        var miktar = parseFloat($(this).parent().prev().prev().text());
        fiyat=parseFloat($(this).parent().next().children().val()); 
        result=(fiyat+(fiyat*kdv)/100)*miktar;
        toplamFiyat += result;
        var name=$(this).attr('name');
        alert("toplamFiyat");
        $("#"+name).text(result);
        $("#toplamFiyatLabel").text("Toplam Fiyat: ");
        $("#toplamFiyatL").text(toplamFiyat);
        $("#toplamFiyat").val(toplamFiyat);
        alert(toplamFiyat);
    }
    
    
});

$('.fiyat').on('change', function() {
                
    var fiyat=parseFloat(this.value);
    var result;
        
    if($(this).parent().prev().children().val() !== '')
    {
        var miktar = parseFloat($(this).parent().prev().prev().prev().text());
        kdv=parseFloat($(this).parent().prev().children().val());
        result=(fiyat+(fiyat*kdv)/100)*miktar;
        toplamFiyat += result;
        var name=$(this).attr('name');
        alert(name);
        $("#"+name).text(result);
        $("label[for='toplamFiyatLabel']").text("toplamFiyat :");
        $("label[for='toplamFiyatL']").text(toplamFiyat);
        $("label[for='toplamFiyat']").val(toplamFiyat);
        alert(toplamFiyat);
    }
                

});
 
$('.teklifGonder').on('click', function() {
    alert('Bu ilana teklif vermek istediğinize emin misiniz ? ');
});
$('.firmaButton').on('click', function() {
   var selected = $("#radioDiv input[type='radio']:checked").val();
    $.ajax({
        type:"GET",
        url: "../set_session",
        data: { role: selected },
        }).done(function(data){
            $('#myModalSirketListe').modal('toggle');
            location.reload();
        }).fail(function(){ 
            alert('Yüklenemiyor !!!  ');
        });
        
});
$(document).ready(function() {
    alert({{session()->get('firma_id')}});
    var firmaId = "{{session()->get('firma_id')}}";
    alert(firmaId);
    if(firmaId === ""){
        $('#myModalSirketListe').modal({
            show: 'true'
        });
    }
    var ilan_turu='{{$ilan->ilan_turu}}';
    var sozlesme_turu='{{$ilan->sozlesme_turu}}';    
            if(ilan_turu=="") 
             {
                          $('#hizmet').hide()
                          $('#mal').hide()
                          $('#goturu').hide()
                          $('#yapim').hide()
             }
            else if(ilan_turu=="Mal" && sozlesme_turu=="Birim Fiyatlı")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                  
                }
             else if(ilan_turu=="Hizmet" && sozlesme_turu=="Birim Fiyatlı")
                {
                   $('#mal').hide()
                   $('#goturu').hide()
                   $('#yapim').hide()
                }
             else if(sozlesme_turu=="Götürü Bedel")
                {
                   $('#hizmet').hide()
                   $('#mal').hide()
                   $('#yapim').hide();
                }
            else if(ilan_turu=="Yapim İşi")
                {
                   $('#hizmet').hide()
                   $('#goturu').hide()
                   $('#mal').hide()
                }      
});
</script>
@endsection
