<template>
    <GenericModal 
        :data_modal="data_modal" 
        @closeModal="closeModal()"
        :header="alert_process?.alert_title"
    >
        <template #content>
            <div class="d-flex align-items-center">
                <i class="pi pi-exclamation-triangle me-2"/>&nbsp;
                <span v-html="`
                        ¿Seguro que desea <strong>${alert_process?.text_alert}</strong> el registro?
                        <br>
                        ${ data_modal?.data_proceso?.extra_info ?? '' }
                    `"
                />
            </div>
            <div class="float-end space-x-2 mt-3">
                <Button
                    type="button"
                    label="Cancelar"
                    class="p-button-text p-button-raised p-button-rounded p-button-warning" 
                    @click="closeModal()"
                />
                <Button 
                    type="submit"
                    :icon="alert_process?.icon"
                    :label="alert_process?.alert_title"
                    :class="`p-button-text p-button-raised p-button-rounded p-button-${alert_process?.color}`"
                    @click="submit()"
                    :loading="form.processing"
                />
            </div>
        </template>
    </GenericModal>
</template>

<script setup>
import { ref, watch } from 'vue';

// Inertia
import { useForm } from "@inertiajs/inertia-vue3";

// Primevue
import Button from "primevue/button";

// Componentes personalizados
import GenericModal from '@/Components/GenericModal.vue';

const form = useForm()
const proceso = ref(null)
const alert_process = ref(null)

const props = defineProps({
    data_modal: Object,
})

const emits = defineEmits(['closeModal'])

// Métodos
const closeModal = () => {
    emits("closeModal");
}
const submit = () => {
    if(proceso.value == 'FORCEDELETE' || proceso.value == 'DESTROY' || proceso.value == 'DELETE'){
        form.delete(route(props.data_modal.data_proceso.ruta, props.data_modal.data_registro), {
            onSuccess: () => {
                closeModal();
            },
        });
    }else if(proceso.value == 'RESTORE'){
        form.post(route(props.data_modal.data_proceso.ruta, props.data_modal.data_registro), {
            onSuccess: () => {
                closeModal();
            },
        });
    }
}

const proceso_execute = () => {
    const data_process = {
        'FORCEDELETE' : {
            'alert_title' : 'Eliminar definitivamente',
            'text_alert' : 'ELIMINAR DEFINITIVAMENTE',
            'icon' : 'pi pi-trash',
            'color' : 'danger'
        },
        'RESTORE' : {
            'alert_title' : 'Restaurar',
            'text_alert' : 'restaurar',
            'icon' : 'bi bi-arrow-counterclockwise',
            'color' : 'success'
        },
        'DELETE' : {
            'alert_title' : 'Eliminar',
            'text_alert' : 'eliminar',
            'icon' : 'pi pi-trash',
            'color' : 'danger'
        },
        'DESTROY' : {
            'alert_title' : 'Eliminar',
            'text_alert' : 'eliminar',
            'icon' : 'pi pi-trash',
            'color' : 'danger'
        }
    }
    alert_process.value = data_process[proceso.value]
}

// Watchers
watch(() => props.data_modal.data_proceso, (newVal) => {
    proceso.value = newVal?.proceso.toUpperCase() ?? null
    proceso_execute()
})
</script>
