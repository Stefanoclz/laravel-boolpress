import Vue from 'vue';

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import HomeComponent from './pages/HomeComponent'
import ContactsComponent from './pages/ContactsComponent'
import NotFoundComponent from './pages/NotFoundComponent'
import WhoWeAreComponent from './pages/WhoWeAreComponent'
import BlogComponent from './pages/BlogComponent'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeComponent,
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: ContactsComponent,
        },
        {
            path: '/*',
            name: 'notFound',
            component: NotFoundComponent,
        },
        {
            path: '/blog',
            name: 'blog',
            component: BlogComponent,
        },
        {
            path: '/who-we-are',
            name: 'who-whe-are',
            component: WhoWeAreComponent,
        }
    ]
})

export default router
