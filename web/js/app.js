var app = new Vue({
  el: '#vueapp',
  data: {
    nombre: '',
    telefono: '',
    regs: [],
    checkedCategories: [],
    results: [],

  },
  methods: {

    reloadList: function() {
      this.$http.get('data.php').then(function(response){
        this.regs = response.body;
      }, function(){
        alert('Error!');
      });
    },

    enviar: function() {
      this.$http.post('data.php',{
        nombre: this.nombre,
        telefono: this.telefono
      }).then(function(response){
        this.regs = response.body;
        this.nombre="";
        this.telefono="";
      });
    },

    check: function(e) {
      this.results = this.checkedCategories
		console.log(this.results)
  },

  enviar_proyectos: function() {
    this.$http.post('data.php',{
      nombre: this.nombre,
      telefono: this.telefono
    }).then(function(response){
      this.regs = response.body;
      this.nombre="";
      this.telefono="";
    });
  },
  uploadFile: function(){

     this.file = this.$refs.file.files[0];

     let formData = new FormData();
     formData.append('file', this.file);

     axios.post('ajaxfile.php', formData,
     {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
     })
     .then(function (response) {

        if(!response.data){
           alert('File not uploaded.');
        }else{
           alert('File uploaded successfully.');
        }

     })
     .catch(function (error) {
         console.log(error);
     });
  },

  },
  created: function() {
    this.reloadList();
  }
});
