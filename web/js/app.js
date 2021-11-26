
var app = new Vue({
  el: '#vueapp',
  data: {
    proyectos: [],
    nombre_proyecto:'',
    software:'',
    cliente:'',
    links:'',
    fecha_inicio:'',
    fecha_fin:'',
    descripcion:'',
    addcofcof:[],
    addpersonal:[],
    nombre_proyecto_update:'',
    software_update:'',
    cliente_update:'',
    links_update:'',
    fecha_inicio_update:'',
    fecha_fin_update:'',
    descripcion_update:'',
    portada_update:'',
    addcofcof_update:[],
    addpersonal_update:[],
    proyectoscofcof: [],
    proyectospersonal: [],
    nombre_proyecto_checked_media:"",
    nombre_proyecto_checked_delete:"",
    mediaName:"No file uploaded",
    coverName:"No file uploaded",
    ordenpersonal:[],
    ordencofcof:[],
    currentab: 1,
    nombre_proyecto_select:''

  },

  methods: {

    reloadList: function() {
      this.$http.get('data.php').then(function(response){
        this.proyectos = response.body.proyectos;
        this.proyectoscofcof = response.body.asignacion.cofcof;
        this.proyectospersonal = response.body.asignacion.personal;
        var json_ordencofcof = response.body.orden.cofcof;
        var json_ordenpersonal =response.body.orden.personal;
        this.ordenpersonal =json_ordenpersonal ;
        this.ordencofcof = json_ordencofcof;

      }, function(){
        alert('Error!');
      });
    },

    crear_proyecto: function() {
      this.file = this.$refs.cover.files[0];
      let formData = new FormData();
      formData.append('file', this.file);
      formData.append('nombre_proyecto', this.nombre_proyecto);
      formData.append('descripcion', this.descripcion);
      formData.append('cliente', this.cliente);
      formData.append('software', this.software);
      formData.append('links', this.links);
      formData.append('fecha_inicio', this.fecha_inicio);
      formData.append('fecha_fin', this.fecha_fin);
      formData.append('cofcof', this.addcofcof);
      formData.append('personal', this.addpersonal);
      axios.post('crear_proyecto.php', formData,
      {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then(function (response) {
        if(!response.data){
          alert('File not uploaded.');
        }else{
          console.log(response.body)
          this.proyectos = response.body;
        }
      })
      .catch(function (error) {
        console.log(error);
      });


    },

    eliminar_proyecto: function() {
      this.$http.post('eliminar_proyecto.php',{
        nombre_proyecto: this.nombre_proyecto_checked_delete,
        proyectoscofcof: this.ordencofcof,
        proyectospersonal: this.ordenpersonal
      }).then(function(response){
        this.proyectos = response.body;
      });
    },

    editar_proyecto: function() {

      this.$http.post('eliminar_proyecto.php',{
        nombre_proyecto: this.nombre_proyecto_update,
        proyectoscofcof: this.ordencofcof,
        proyectospersonal: this.ordenpersonal
      }).then(function(response){
        this.$http.post('crear_proyecto.php',{
          nombre_proyecto: this.nombre_proyecto_update,
          descripcion: this.descripcion,
          cliente: this.cliente,
          software: this.software,
          fecha_inicio: this.fecha_inicio,
          fecha_fin: this.fecha_fin,
          cofcof: this.addcofcof,
          personal: this.addpersonal,
          portada: this.portada,

        });
      }).then(function(response){
        this.proyectos = response.body;
      });


    },



    select_project: function(e) {
      var project =  this.proyectos[this.nombre_proyecto_select];
      var map = new Map(Object.entries(project));
      map.forEach((item, i) => {
        this.cliente_update = item["cliente"];
        this.software_update = item["software"];
        this.links_update = item["links"];
        this.fecha_inicio_update = item["fecha_inicio"];
        this.fecha_fin_update = item["fecha_fin"];
        this.descripcion_update = item["descripcion"];
        this.links_update = item["links"];
        this.nombre_proyecto_update = item["nombre_proyecto"];
        this.addcofcof_update = item["cofcof"];
        this.addpersonal_update = item["personal"];
        this.portada_update = "https://"+item["portada"];
      });

      console.log()
    },
    isActive (menuItem) {
      return this.currentab === menuItem
    },
    setActive (menuItem) {
      this.currentab = menuItem
    },

    ordenar_proyectos:function(e){
      this.$http.post('ordenar_proyecto.php',{
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

    mediaChoosen:function(e){
      this.mediaName = e.target.files[0].name;
    },
    coverChoosen:function(e){
      this.coverName = e.target.files[0].name;
    },
    uploadFile: function(){

      this.file = this.$refs.file.files[0];
      let formData = new FormData();
      formData.append('file', this.file);
      formData.append('nombre_proyecto', this.nombre_proyecto_checked_media);
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
