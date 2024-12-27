$("[name='my-checkbox']").bootstrapSwitch();
  $('.select2').select2({
    height: "resolve"
  });
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  
  

  $(function () {
    // Summernotez
    $('.summernote').summernote(  {
      height: 200,
    })
  })

// Image Preview 
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('image_preview');
        $('.image_div').css('display', 'block');
        output.src = reader.result;
        $('.previous_image').css('display', 'none');
    };
    $('.previous_image').css('display', 'block');
    $('.image_div').css('display', 'none');
    reader.readAsDataURL(event.target.files[0]);
  };

  $(document).ready(function(){

    $('body').on('keyup', "input[name=name], input[name=title] ", function() {
                var name = $(this).val();
                var newValue = '';
                var regx = /^[A-Za-z0-9_-]+$/;

                for (var i = 0; i < name.length; i++) {
                    if (regx.test(name.charAt(i))) {
                        newValue = newValue + name.charAt(i);
                    } else if (name.charAt(i) == ' ') {
                        if (newValue.charAt(newValue.length - 1) == '-') {
                            newValue = newValue;
                        } else {
                            newValue = newValue + '-';
                        }

                    } else {
                        newValue = newValue;
                    }
                }
    // Find the nearest input field with the name attribute "slug"
        var $slugInput = $(this).closest('form').find('input[name=slug]').first();
    // Set the value of the closest input field with name attribute "slug"
         $slugInput.val(newValue.toLowerCase());
            });

            $("input[name=slug]").keyup(function() {
                var slug = $(this).val();  
                var newValue = '';

                var regx = /^[A-Za-z0-9_-]+$/;

                for (var i = 0; i < slug.length; i++) {
                    if (regx.test(slug.charAt(i))) {
                        newValue = newValue + slug.charAt(i);
                    } else if (slug.charAt(i) == ' ') {
                        newValue = newValue + '-';
                    } else {
                        newValue = newValue.toLowerCase();
                    }
                }
                // Find the nearest input field with the name attribute "slug"
        var $slugInput = $(this).closest('form').find('input[name=slug]').first();
        // Set the value of the closest input field with name attribute "slug"
             $slugInput.val(newValue.toLowerCase());

            });
        });

  
 