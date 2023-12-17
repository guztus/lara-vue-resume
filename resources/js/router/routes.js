const Home = () => import('../views/Home.vue');
const About = () => import('../views/About.vue');

export default [
    {
        path: '/',
        component: Home,
        name: 'home',
    },
    {
        path: '/about',
        component: About,
        name: 'about'
    }
];
