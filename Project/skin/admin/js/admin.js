var admin = {
    url : null,
    type : 'POST',
    data : {},
    dataType : 'json',
    form : null,

    setUrl : function(url){
        this.url = url;
        return this;
    },

    getUrl : function(){
        return this.url;
    },

    setType : function(type){
        this.type = type;
        return this;
    },

    getType : function(){
        return this.type;
    },

    setData : function(data){
        this.data = data;
        return this;
    },

    getData : function(){
        return this.data;
    },

    setForm : function(form){
        this.form = form;
        this.prepareFormParams();
        return this;
    },

    getForm : function(){
        return this.form;
    },

    prepareFormParams : function(){
        this.setUrl(this.getForm().attr('action'));
        this.setType(this.getForm().attr('method'));
        this.setData(this.getForm().serializeArray());
        return this;
    },

    setDataType : function(dataType){
        this.dataType = dataType;
        return this;
    },

    getDataType : function(){
        return this.dataType;
    },

    load : function(){
        const self = this;
        $.ajax({
            url: this.getUrl(),
            type: this.getType(),
            data: this.getData(),
            success: function(data){
                self.manageElemants(data.elements);
            }             
        });
    },

    manageElemants : function(elements) {
        jQuery(elements).each(function(index,element) {
            if(element.element == '#adminMessage')
            {
                if(element.content)
                {
                    var Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                    });
                    let text = element.content;
                    const myArray = text.split(":");
                    const type = myArray[0];
                    const msg = myArray[1];
                    if(type == 'success')
                    {
                        Toast.fire({
                            icon: 'success',
                            title: msg
                        });
                    }
                    else if(type == 'warning')
                    {
                        Toast.fire({
                            icon: 'warning',
                            title: msg
                        });
                    }
                    else if(type == 'error')
                    {
                        Toast.fire({
                            icon: 'error',
                            title: msg
                        });
                    }
                }
            }
            else
            {
                jQuery(element.element).html(element.content);
                if(element.classAdd != undefined)
                {
                    jQuery(element.element).addClass(element.classAdd);
                }
            }
        });
    }
}
