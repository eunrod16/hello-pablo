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

  },
  created: function() {
    this.reloadList();
  }
});
