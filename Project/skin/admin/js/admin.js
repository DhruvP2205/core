var admin1 = {
    url : null,
    type : 'POST',
    data : {},
    dataType : 'json',
    form : null,

    setUrl : function(url) {
        this.url = url;
        return this;
    },

    getUrl : function(){
        return this.url;
    },

    setType : function(type) {
        this.type = type;
        return this;
    },

    getType : function(){
        return this.type;
    },

    setData : function(data) {
        this.data = data;
        return this;
    },

    getData : function(){
        return this.data;
    },

    setDataType : function(dataType) {
        this.dataType = dataType;
        return this;
    },

    getDataType : function(){
        return this.dataType;
    },

    setForm : function(form) {
        this.form = form;
        this.prepareFormParam();
        return this;
    },

    getForm : function(){
        return this.form;
    },

    prepareFormParam : function(){
        this.setUrl(this.getForm().attr('action'));
        this.setType(this.getForm().attr('method'));
        this.setData(this.getForm().serializeArray());
        return this;
    },


    load : function(){
        $.ajax({
            url: this.getUrl(),
            type: this.getType(),
            data: this.getData(),
            dataType : this.getDataType(),
            form : this.getForm(),
            success: function(data){
                console.log(data);
            }
        });
    },
}
