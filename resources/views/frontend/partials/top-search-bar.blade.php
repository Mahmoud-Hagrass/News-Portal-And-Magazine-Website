<div class="brand">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-8">
                <div class="b-logo">
                    <a href="index.html">
                        <img src="{{ asset('assets-front') }} {{ $site_settings->logo }}" alt="Logo" />
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
            </div>
            <div class="col-lg-3 col-md-4">
              <form>  
                <div class="b-search">
                    <input type="text" name="search" id="search_id" placeholder="Search"/>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script>
        let desponse ;  // this desponse must be outside event 
        var mainPageData = $('#search_result').html() ; 
        $(document).on('input' , '#search_id' , function(e){
        
            e.preventDefault() ;
            var search = $(this).val() ; 
            var csrf_token = $('meta[name="csrf-token"]').attr('content') ; 

                  clearTimeout(desponse) ;
                  if(search.length >=1){
                   desponse = setTimeout(() => {
                    $.ajax({
                        url: "{{ route('frontend.post.search') }}" , 
                        type: "POST" , 
                        dataType:"html" ,
                        data: {
                            'post':search
                        } , 
                        headers:{
                            'X-CSRF-TOKEN': csrf_token
                        },
                        success:function(response){
                            $('#search_result').html(response) ;
                        }, 
                        error:function(response){
                            $('#search_result').html('');
                        }
                   }) ;
                
                  }, 1000);
              }else{
                    $('#search_result').html(mainPageData) ;
                } 
            }) ;

    </script>
@endpush