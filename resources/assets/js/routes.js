import VueRouter from 'vue-router';

let routes = [
	{
		path: '/',
		component: require('./views/Home')
	},
	{
		name: 'single',
		path: '/konkurs/:id',
		component: require('./views/Single')
	},
	{
		name: 'thanks',
		path: '/dziekujemy',
		component: require('./views/Thanks')
	},
	{
		name: 'finished',
		path: '/zakonczone',
		component: require('./views/Finished')
	},
];

export default new VueRouter({
	routes,
	scrollBehavior (to, from, savedPosition) {
    	 return new Promise((resolve, reject) => {
		    setTimeout(() => {
		      resolve({ x: 0, y: 0 })
		    }, 200)
		  })
   },
   mode: 'history'
});
