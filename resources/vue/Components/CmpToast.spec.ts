import { describe, it, expect } from 'vitest';
import { mount } from '@vue/test-utils';
import CmpToast from './CmpToast.vue';

describe('CmpToast.vue', () => {
    it('mounts and exposes toastDisplay', () => {
        const wrapper = mount(CmpToast);
        expect(wrapper.exists()).toBe(true);

        expect(typeof (wrapper.vm as any).toastDisplay).toBe('function');
    });
});
