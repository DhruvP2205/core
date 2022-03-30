<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/style.css">
    <script src="skin/admin/js/jquery-3.6.0.min.js"></script>
    <!-- <script src="skin/admin/js/admin.js"></script> -->
    <title><?php echo $this->getTitle(); ?></title>

    <script type="text/javascript">
        admin = {
            url : null,
            type : 'POST',
            data : {},
            dataType : 'json',
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
            setType : function(type) {
                this.type = type;
                return this;
            },
            getType : function(){
                return this.type;
            },
            setDataType : function(dataType) {
                this.dataType = dataType;
                return this;
            },

            getDataType : function(){
                return this.dataType;
            },
            setData : function(data) {
                this.data = data;
                return this;
            },
            getData : function() {
                return this.data;
            },
            setForm : function(form) {
                this.form = form;
                this.prepareFormParam();
                return this;
            },
            getForm : function() {
                return this.form;
            },
            prepareFormParam : function(){
                this.setUrl(this.getForm().attr('action'));
                this.setType(this.getForm().attr('method'));
                this.setData(this.getForm().serializeArray());
                return this;
            },
            validate : function(){
                var canSubmit = true;
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
            },
             load : function(){
                $.ajax({
                    url: this.getUrl(),
                    type: this.getType(),
                    data: this.getData(),
                    success: function(data){
                        jQuery("#content").html(data);
                    }             
                });
            },
        };
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
