<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetActionSection from '@/Jetstream/ActionSection.vue';
import JetDialogModal from '@/Jetstream/DialogModal.vue';
import JetDangerButton from '@/Jetstream/DangerButton.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';

import Button from 'primevue/button';
import Password from 'primevue/password'

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    setTimeout(() => passwordInput.value.focus(), 250);
};

const deleteUser = () => {
    form.delete(route('current-System.user.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <JetActionSection>
        <template #title>
            <div class="inline-flex align-items-center">
                <i class="fs-4 bi bi-person-x mr-2"></i>
                <b class="text-lg">Eliminar cuenta</b>
            </div>
        </template>

        <template #content>
            <div class="max-w-xl text-sm md:text-base">
                Una vez que su cuenta es eliminada <strong>toda la información y archivos serán eliminados permanentemente</strong>. Antes de eliminar su cuenta, por favor, respalde cualquier información que desearía conservar.
            </div>

            <div class="mt-5 flex justify-content-end">
                <Button
                    icon="pi pi-trash"
                    class="p-button-raised p-button-rounded p-button-danger"
                    label="Eliminar cuenta"
                    @click="confirmUserDeletion"
                />
            </div>

            <!-- Delete Account Confirmation Modal -->
            <JetDialogModal :show="confirmingUserDeletion" @close="closeModal">
                <template #title>
                    <i class="fs-5 bi bi-person-x mr-2"></i>
                    <b class="text-lg">Eliminar cuenta</b>
                </template>

                <template #content>
                    <p class="text-sm md:text-base">¿Está seguro de eliminar su cuenta? Una vez que su cuenta es eliminada <strong>toda la información y archivos serán eliminados permanentemente</strong>. Por favor, ingrese su contraseña para confirmar que desea <strong>eliminar permanentemente</strong> su cuenta.</p>

                    <div class="mt-4">
                        <Password
                            :class="{'p-invalid': form.errors.password}"
                            v-model="form.password"
                            toggleMask 
                            :feedback="false"
                            placeholder="Contraseña"
                            @keyup.enter="deleteUser"
                        />

                        <JetInputError :message="form.errors.password" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <Button
                        class="p-button-raised p-button-rounded p-button-sm p-button-warning p-button-text"
                        label="Cancelar"
                        @click="closeModal"
                    />

                    <Button
                        icon="pi pi-trash"
                        class="p-button-raised p-button-rounded p-button-sm p-button-danger ml-3"
                        label="Eliminar cuenta"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    />
                </template>
            </JetDialogModal>
        </template>
    </JetActionSection>
</template>
