<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title><?php echo $this->getTitle(); ?></title>

    <script type="text/javascript">
        admin = {
            url : 'index.php',
            form : null,
            params : {
                email : "dhruv@gmail.com",
            },
            setUrl : function(url) {
                this.url = url;
                return this;
            },
            getUrl : function() {
                return this.url;
            },
            setData : function(data) {
                this.data = data;
                return this;
            },
            getData : function() {
                return this.data;
            },
            setForm : function(form) {
                this.form = jQuery('#' + form);
                return this;
            },
            getForm : function() {
                return this.form;
            },
            validate : function(){
                var canSubmit = true;
                // if(!jQuery("#name").val())
                // {
                //     alert('Plz enter name.');
                //     canSubmit = false;
                // }
                // if(!jQuery("#email").val())
                // {
                //     alert('Plz enter email.');
                //     canSubmit = false;
                // }
                // if(!jQuery("#mobile").val())
                // {
                //     alert('Plz enter mobile.');
                //     canSubmit = false;
                // }
                if(canSubmit == true)
                {
                    this.callSaveAjax();
                }
                return false;
            },
            callSaveAjax : function(){
                $.ajax({
                    url: "<?php echo $this->getUrl('save') ?>",
                    type: "POST",
                    data: this.getData(),
                    success: function(data){
                        $("#message").html(data);
                    }
                });
            },
            callDeleteAjax : function(){
                $.ajax({
                    url: "<?php echo $this->getUrl('delete') ?>",
                    type: "GET",
                    data: this.getData(),
                    success: function(data){
                        $("#message").html(data);
                    }
                });
            }
        };
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#submit").click(function(){
                var data = $("#form-admin").serializeArray();
                admin.setData(data);
                admin.validate();
            });
        });
    </script>

    <script type="text/javascript">
    function pprFunction()
    {
        const pprValue = document.getElementById('pageSelect').selectedOptions[0].value;
        let url = window.location.href;
        
        if(!url.includes('ppr'))
        {
            url += '&ppr=20';
        }
        const urlArray = url.split("&");

        for (i = 0; i < urlArray.length; i++)
        {
            if(urlArray[i].includes('p='))
            {
                urlArray[i] = 'p=1';
            }
            if(urlArray[i].includes('ppr='))
            {
                urlArray[i] = 'ppr=' + pprValue;
            }
        }
        const finalUrl = urlArray.join("&");  
        location.replace(finalUrl);
    }
</script>

</head>
