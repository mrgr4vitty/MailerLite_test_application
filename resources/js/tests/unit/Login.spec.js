import { shallowMount, createLocalVue } from '@vue/test-utils';
import expect from 'expect';
import Login from '../../components/Login.vue';
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
Vue.use(Vuetify);

describe('Login.vue', () => {
    let wrapper, localVue;
    beforeEach(() => {
        // This is better when we are testing plugins like vuex or VueRouter
        localVue = createLocalVue();
        localVue.use(VueRouter);
    });

    it('Visiting Login page', () => {
        let router = new VueRouter();
        let vuetify = new Vuetify();
        let wrapper = shallowMount(Login, {localVue, router, vuetify});
        //expect(wrapper.find('div').text()).toContain('Login form');
        expect(wrapper.vm.message).toBe(false);
    });
});
