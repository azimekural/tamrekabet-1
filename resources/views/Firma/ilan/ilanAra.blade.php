
@extends('layouts.ilanApp')
 @section('content')
 
    <style>
           input[type=text] {
               width: 200px;
               box-sizing: border-box;
               border: 1px solid #ccc;
               border-radius: 4px;
               font-size: 16px;
               background-color: white;
               background-image: url("{{asset('images/search.png')}}");
               background-position: 10px 10px;
               background-repeat: no-repeat;
               padding: 12px 20px 12px 40px;
               -webkit-transition: width 0.4s ease-in-out;
               transition: width 0.4s ease-in-out;
           }

           input[type=button] {
               background-color: #63b8ff;
               border: 2px solid #ccc;
               color: white;
               border-radius: 4px;
              padding: 12px 8px 12px 8px;
               text-decoration: none;
               margin: 4px 2px;
              
           }
           .header{
               background-color: #f5f5f5;
               width: 100%;
               height: 100px;
               
           }
           .search{
               width: 270px;
               box-sizing: border-box;
               border: 1px solid #ccc;
               border-radius: 4px;
               font-size: 12px;
               background-color:#C0C0C0;
               padding: 12px 8px 12px 8px;
               
           }
           .soldivler{
                width: 270px;
               box-sizing: border-box;
               border: 1px solid #ccc;
               border-radius: 4px;
               font-size: 12px;
               background-color: #f5f5f5;
               padding: 12px 8px 12px 8px;
               
           }
          

            .dropdown {



            }

            a {
              color: #fff;
            }

            .dropdown dd,
            .dropdown dt {
              margin: 0px;
              padding: 0px;
            }

            .dropdown ul {
              margin: -1px 0 0 0;
            }

            .dropdown dd {
              position: relative;
            }

            .dropdown a,
            .dropdown a:visited {
              color: #333;
              text-decoration: none;
              outline: none;
              font-size: 12px;
            }

            .dropdown dt a {
              background-color: #FFF;
              display: block;

              min-height: 25px;
              line-height: 24px;
              overflow: hidden;
              border: 0;
              border-radius: 4px;
              width: 250px;
            }

            .dropdown dt a span,
            .multiSel span {
              cursor: pointer;
              display: inline-block;
              padding: 0 3px 2px 0;
            }

            .dropdown dd ul {
              background-color: #4F6877;
              border: 0;
              color: #fff;
              display: none;
              left: 0px;
              padding: 2px 15px 2px 5px;
              position: absolute;
              top: 2px;
              width: 250px;
              list-style: none;
              height: 170px;
              overflow: auto;
            }

            .dropdown span.value {
              display: none;
            }

            .dropdown dd ul li a {
              padding: 5px;
              display: block;
            }

            .dropdown dd ul li a:hover {
              background-color: #fff;
            }

            button {
              background-color: #6BBE92;
              width: 302px;
              border: 0;
              padding: 10px 0;
              margin: 5px 0;
              text-align: center;
              color: #fff;
              font-weight: bold;
            }
            .pclass {
    color: rgb(255, 255, 255);
    border-top-right-radius: 15px;
    border-bottom-right-radius: 15px;
    border-bottom-left-radius: 15px;
    border-top-left-radius: 15px;
    display: inline-block;
    zoom: 1;
    font: 13px/18px roboto;
    background: rgb(128, 30, 138);
    padding: 5px;
}

       
           
   </style>

   
   <div id="header">
       <div  class="container-fuild">
           <div class="row content"  >
               <div class="col-sm-6">
                   <?php $ilan = DB::table('ilanlar')->count();?>
                   <h4>Arama kriterlerinize uyan <img src="{{asset('images/sol.png')}}"> {{$ilan}} ilan </h4>
                   
                   
               </div>
               <div class="col-sm-4">
                   <ul style="list-style-type: none">
                       <li>
                           <p class="pclass ">
                               <span class="multiSel"><img src="{{asset('images/kapat.png')}}"> </span> 
                               <span class="multiSel"><img src="{{asset('images/kapat.png')}}"> </span>
                               
                           
                           
                           </p>
                       </li>
                       <li>
                           <p class="pclass ">
                               <span class="multiSel"></span> 
                               <span class="multiSel"></span>
                               <img src="{{asset('images/kapat.png')}}"> 
                           
                           
                           </p>
                       </li>
                   </ul>
                   
                  
                   
               </div>
               <div class="col-sm-2">
                   
                   <img src="{{asset('images/sil1.png')}}">&nbsp;Temizle</img>
               </div>
           </div>
       </div>

   </div>
   
   
   <br>
   <br>
   <br>
     <div class="container">
    
      
       <div  class="container-fluid" style="width:100%">
              <div class="row content" style="padding-top: 0px" >
                 <div class="col-sm-3">
                     
                     
                     <div class="search" id="radioDiv3">
                         
                                <div>
                                    <input type="text" name="search" id="search" placeholder="Anahtar Kelime"><input type="button" id="button"  value="ARA">
                                </div>
                                <div>
                                   <input type="radio" name="gender" value="tum"> Tüm İlanda<br>
                                   <input type="radio" name="gender" value="ilan_baslık"> Sadece İlan Başlığında<br>
                                   <input type="radio" name="gender" value="firma"> Sadece Firma Adında Ara
                                </div>
                            
                     </div>
                     <br>
                     <div class="soldivler">
                         <form  >
                             <h4>İllerde Arama</h4>
                             <br>
                             <br>
                              <dl class="dropdown"> 

                                <dt>
                                <a href="#">
                                  <span class="hida">Seçiniz<span class="caret"></span></span>    
                                  
                                </a>
                                </dt>

                                <dd>
                                    <div class="mutliSelect">
                                        <ul>
                                            @foreach($iller as $il)
                                            <li>
                                                <input type="checkbox" value="{{$il->id}}" />{{$il->adi}}</li>
                                            @endforeach
                                            
                                        </ul>
                                    </div>
                                </dd>
                            </dl>
                         </form>
                     </div>
                    
                     <div class="soldivler">
                         
                             <h4>İlan Tarihi Aralığı</h4>
                             <p>Başlangıç Tarihi</p>
                              <input type="date" class="form-control datepicker" id="baslangic_tarihi" name="baslangic_tarihi" placeholder="" value="">
                                  <br>
                             <p>Bitiş Tarihi</p>
                              <input type="date" class="form-control datepicker" id="bitis_tarihi" name="bitis_tarihi" placeholder="" value="">
                      
                     </div>
                     <div class="soldivler">
                         
                             <h4>İlan Sektörü</h4>
                             @foreach($sektorler as $sektor)
                              <input type="checkbox" name="sektor[]" class="checkboxClass" value="{{$sektor->id}}"> {{$sektor->adi}}<br>
                             @endforeach
                      
                     </div>
                     <div class="soldivler" id="radioDiv">
                             <h4>İlan Türü</h4>
                             <input type="radio" name="ilanTuru[]" class="tur" value="Mal"><span class="lever"></span>Mal<br>
                             <input type="radio" name="ilanTuru[]" class="tur" value="Hizmet"><span class="lever"></span>Hizmet<br>
                             <input type="radio" name="ilanTuru[]" class="tur" value="Yapım İşi"><span class="lever"></span>Yapım İşi
                     </div>
                     <div class="soldivler" id="radioDiv2">
                             <h4>İlan Usulü</h4>
                              <input type="radio" name="gender[]" class="usul" value="Açık"> Açık<br>
                              <input type="radio" name="gender[]" class="usul" value="Belirli İstekler Arasında">Belirli İstekler Arasında<br>
                              <input type="radio" name="gender[]" class="usul" value="Başvuru">Başvuru
                             
                     </div>      
                            
                            
                 </div>
                 <div class="col-sm-9" id="auto_load_div">
                         <?php $i=0;?>  
                        <h3>İlanlar</h3>
                                           <hr>
                                           @foreach($querys as $query)
                                              <p id="ilan{{$i}}">{{$query->adi}}</p>
                                              <p id="adi{{$i}}">{{$query->firmalar->adi}}</p>
                                              <hr id="hr{{$i}}">
                                             <?php $i++;?>
                                           @endforeach
                                        {{$querys->links()}}
                </div>
                       
                 </div>
           <script>
            

           
           </script> 
            <script type="text/javascript">
                      
                      function auto_load(){
                            var il_id=$('#il_id').val();
                            var basTar=$('#baslangic_tarihi').val();
                            var bitTar=$('#bitis_tarihi').val();
                            var selectedSektor = new Array();
                            var n = jQuery(".checkboxClass:checked").length;
                            if (n > 0){
                                jQuery(".checkboxClass:checked").each(function(){
                                    selectedSektor.push($(this).val());
                                });
                            }
                            var selectedIl = new Array();
                            var n = jQuery('.mutliSelect input[type="checkbox"]').length;
                            if (n > 0){
                                jQuery('.mutliSelect input[type="checkbox"]:checked').each(function(){
                                    selectedIl.push($(this).val());
                                });
                            }
                            
                            var selectedTur = "";
                            var selected = $("#radioDiv input[type='radio']:checked");
                            if (selected.length > 0) {
                                selectedTur = selected.val();
                            }
                            var selectedUsul = "";
                            var selected2 = $("#radioDiv2 input[type='radio']:checked");
                            if (selected2.length > 0) {
                                selectedUsul = selected2.val();
                            }
                            var selectedUsul = "";
                            var selected2 = $("#radioDiv2 input[type='radio']:checked");
                            if (selected2.length > 0) {
                                selectedUsul = selected2.val();
                            }
                            var selectedSearch = "";
                            var inputSearch = "";
                            var selected3 = $("#radioDiv3 input[type='radio']:checked");
                            if (selected3.length > 0) {
                                selectedSearch = selected3.val();
                                inputSearch=$('#search').val();
                            }
                            alert(selectedSearch);
                            $.ajax({
                              type:"GET",
                              url: "ilanAraFiltre",
                              data:{il:selectedIl,bas_tar:basTar,bit_tar:bitTar,sektor:selectedSektor,tur:selectedTur,usul:selectedUsul,radSearch:selectedSearch,input:inputSearch},
                              cache: false,
                              success: function(data){
                                 console.log(data);
                                 for(var key=0; key < {{$i}};key++)
                                {
                                 $("#ilan"+key).empty();
                                 $("#adi"+key).empty();
                                 $("#hr"+key).hide();
                                }
                                for(var key=0; key <Object.keys(data).length;key++)
                                {
                                 $("#ilan"+key).append(data[key].ilanadi);
                                 $("#adi"+key).append(data[key].yayin_tarihi);
                                 $("#hr"+key).append("<hr />");
                                }
                                 
                              } 
                            });
                    }
                    $('#button').click(function(){
                        auto_load();
                    });
                
                    $('#il_id').change(function(){
                        auto_load();
                    });
                    $('#baslangic_tarihi').change(function(){
                        auto_load();
                    });
                    $('#bitis_tarihi').change(function(){
                        auto_load();
                    });
                    $('.tur').click(function(){
                        auto_load();
                    });
                    $('.usul').click(function(){
                        auto_load();
                    });
                
                     $(".dropdown dt a").on('click', function() {
                    $(".dropdown dd ul").slideToggle('fast');
                  });

                  $(".dropdown dd ul li a").on('click', function() {
                    $(".dropdown dd ul").hide();
                  });

                  function getSelectedValue(id) {
                    return $("#" + id).find("dt a span.value").html();
                  }

                  $(document).bind('click', function(e) {
                    var $clicked = $(e.target);
                    if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
                  });

                  $('.mutliSelect input[type="checkbox"]').on('click', function() {

                    var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
                      title = $(this).val() + ",";

                    if ($(this).is(':checked')) {
                      var html = '<span title="' + title + '">' + title + '</span>';
                      $('.multiSel').append(html);
                      $(".hida").hide();
                      auto_load();
                    } else {
                      $('span[title="' + title + '"]').remove();
                      var ret = $(".hida");
                      $('.dropdown dt a').append(ret);

                    }
  
                });
   
                  </script>
                  
        <hr>
    </div>
  
@endsection
