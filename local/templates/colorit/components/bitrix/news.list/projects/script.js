    $(document).ready( function (){
        $('.item-link').on( "click", function(e) {
            e.preventDefault();
            let id = e.currentTarget.dataset.id
            if (id==null) return;
            console.log()
            $.ajax({
                url: '/ajax/galery.php',
                method: 'post',
                data: {id: id},
                success: function(response) {
                    let arr = JSON.parse(response);
                    listPict = []
                    for (i=0; i < arr.length; i++) {
                        listPict.push({'src': arr[i]})
                    }
                    options= {
                        Toolbar: {
                            display: {
                                left: [],
                                right: ["close"],
                            },
                        },
                    }
                    new Fancybox(
                        listPict,
                        options,

                );
                },
                error: function(error) {
                    console.log('error', error)
                }
            })

        });
        } );




