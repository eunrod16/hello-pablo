var app = new Vue({
  el: '#vueapp',
  data: {
    nombre: '',
    telefono: '',
    regs: [],
    checkedCategories: [],
    results: [],
    nombre_proyecto:'',
    software:'',
    cliente:'',
    links:'',
    fecha_inicio:'',
    fecha_fin:'',
    descripcion:'',
    proyectoscofcof: [],
    proyectospersonal: [],

  },
  methods: {

    reloadList: function() {
      this.$http.get('data.php').then(function(response){
        this.regs = response.body;
        this.proyectoscofcof = response.body.asignacion.cofcof;
        this.proyectospersonal = response.body.asignacion.personal;
      }, function(){
        alert('Error!');
      });
    },

    crear_proyecto: function() {
      this.$http.post('crear_proyecto.php',{
        nombre_proyecto: this.nombre_proyecto,
        descripcion: this.descripcion,
        cliente: this.cliente,
        software: this.software,
        fecha_inicio: this.fecha_inicio,
        fecha_fin: this.fecha_fin
      }).then(function(response){
        this.regs = response.body;
        this.nombre_proyecto= "";
        this.descripcion="";
        this.cliente="";
        this.software="";
        this.fecha_inicio="";
        this.fecha_fin=""
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

    checkcofcof: function(e) {
      console.log(this.proyectoscofcof)
    },
    checkpersonal: function(e) {
      console.log(this.proyectospersonal)
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
