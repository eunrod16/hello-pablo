
var app = new Vue({
  el: '#vueapp',
  data: {
    regs: [],
    nombre_proyecto:'',
    software:'',
    cliente:'',
    links:'',
    fecha_inicio:'',
    fecha_fin:'',
    descripcion:'',
    proyectoscofcof: [],
    proyectospersonal: [],
    nombre_proyecto_checked:"",
    nombre_proyecto_checked_delete:"",
    addcofcof:[],
    addpersonal:[],
    mediaName:"No file uploaded",
    ordenpersonal:[],
    ordencofcof:[],

    currentab: 0

  },

  methods: {

    reloadList: function() {
      this.$http.get('data.php').then(function(response){
        this.regs = response.body;
        this.proyectoscofcof = response.body.asignacion.cofcof;
        this.proyectospersonal = response.body.asignacion.personal;
        var json_ordencofcof = response.body.orden.cofcof;
        var json_ordenpersonal =response.body.orden.personal;

        this.ordenpersonal = [];
        this.ordencofcof = [];

        for(var i in json_ordencofcof)
        this.ordencofcof.push({name: json_ordencofcof [i]});

        for(var i in json_ordenpersonal)
        this.ordencofcof.push({name: json_ordenpersonal [i]});

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
        fecha_fin: this.fecha_fin,
        cofcof: this.addcofcof,
        personal: this.addpersonal,
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

    eliminar_proyecto: function() {
      this.$http.post('eliminar_proyecto.php',{
        nombre_proyecto: this.nombre_proyecto_checked_delete,
      }).then(function(response){
        this.regs = response.body;
      });
    },


    check: function(e) {
      console.log(this.nombre_proyecto_checked)
    },
    checkMove: function(e) {
      window.console.log("Future index: " + e.draggedContext.futureIndex);
    },

    ordenar_proyectos:function(e){
      this.$http.post('orden_proyecto.php',{
        proyectoscofcof: this.ordencofcof,
        proyectospersonal: this.ordenpersonal
      }).then(function(response){

      });
    },

    asignar_proyecto: function(e) {
      this.$http.post('pagina_proyecto.php',{
        proyectoscofcof: this.proyectoscofcof,
        proyectospersonal: this.proyectospersonal
      }).then(function(response){

      });
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
    mediaChoosen:function(e){
      this.mediaName = e.target.files[0].name;
    },
    uploadFile: function(){

      this.file = this.$refs.file.files[0];

      let formData = new FormData();
      formData.append('file', this.file);
      formData.append('nombre_proyecto', this.nombre_proyecto_checked);

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
