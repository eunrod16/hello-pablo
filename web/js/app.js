var app = new Vue({
  el: '#vueapp',
  data: {
	nombre: '',
	telefono: '',
	regs: []
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
		}

	},
  created: function() {
	this.reloadList();
	}
});
