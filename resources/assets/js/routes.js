import VueRouter from 'vue-router'



let routes = [
	
	{
		path:'/',
		component:require('./components/mahasiswa/index')

	},
	{
		path:'/add',
		component:require('./components/mahasiswa/add')
	},
	{
		path:'/edit/:id',
		name : 'mahasiswaEdit',
		component:require('./components/mahasiswa/edit')
	}

]


export default new VueRouter({
	routes,
	mode:'history'
})