const Welcome = () => import('../views/Welcome.vue');
const About = () => import('../views/About.vue');

export default [
    {
        path: '/',
        component: Welcome,
        name: 'welcome',
    },
    {
        path: '/about',
        component: About,
        name: 'about'
    }
];
