import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import InquiryPage from '../components/InquiryPage.vue';
import CoursesPage from '../components/CoursesPage.vue';
import AboutUsPage from '../components/AboutUsPage.vue';
import ContactPage from '../components/ContactPage.vue';
import CertificateVerify from '../components/CertificateVerify.vue';

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/inquiry',
        name: 'inquiry',
        component: InquiryPage,
        meta: { title: 'Inquiry - Contact Us' }
    },
    {
        path: '/courses',
        name: 'courses',
        component: CoursesPage,
        meta: { title: 'Courses - SK Python Classes' }
    },
    {
        path: '/about-us',
        name: 'about-us',
        component: AboutUsPage,
        meta: { title: 'About Us - SK Python Classes' }
    },
    {
        path: '/contact',
        name: 'contact',
        component: ContactPage,
        meta: { title: 'Contact Us - SK Python Classes' }
    },
    {
        path: '/certificateverify',
        name: 'certificate.verify',
        component: CertificateVerify,
        meta: { title: 'Verify Certificate - SK Python Classes' }
    },
    {
        path: '/certificateverify/:certificateNumber',
        name: 'certificate.verify.number',
        component: CertificateVerify,
        meta: { title: 'Verify Certificate - SK Python Classes' }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { top: 0, behavior: 'smooth' };
        }
    }
});

export default router;

