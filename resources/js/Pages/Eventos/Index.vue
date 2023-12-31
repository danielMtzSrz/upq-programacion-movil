<template>
    <GenericLayout titleModule="Eventos">
        <template #content>
            <DynamicTable
                :data="eventos"
                :items="items"
                titleModule="Eventos"
            >
                <template #header>
                    <Button
                        type="button"
                        label="Nuevo"
                        icon="pi pi-plus"
                        class="p-button-raised p-button-rounded p-button-success p-button-sm p-button-text"
                        @click="modalCreateUpdate({display: true})"
                    />
                </template>

                <template #buttons="{ data }">
                    <Button
                        type="button"
                        icon="pi pi-pencil"
                        class="p-button-warning p-button-text p-button-raised p-button-rounded"
                        v-tooltip.top="'Actualizar'"
                        @click="modalCreateUpdate({display: true, data: data})"
                    />
                    <Button
                        type="button"
                        icon="pi pi-trash"
                        class="p-button-danger p-button-text p-button-raised p-button-rounded"
                        @click="modalGenericAlert({
                            data: data, 
                            display: true, 
                            proceso: {
                                'proceso': 'delete',
                                'ruta': 'eventos.destroy',
                            }
                        })"
                    />
                    <Button
                        type="button"
                        icon="pi pi-check"
                        class="p-button-success p-button-text p-button-raised p-button-rounded"
                        @click="modalGenericAlert({
                            data: {id: data.id}, 
                            display: true, 
                            proceso: {
                                'proceso': 'restore',
                                'ruta': 'listaasistencia.store',
                                'extra_info': '¿Seguroo que te quieres unir al evento?'
                            }
                        })"
                        v-tooltip="'Unirme al evento'"
                    />
                </template>
            </DynamicTable>
        </template>

        <template #footer>
            <CreateUpdate
                :data_modal="{
                    display: display_create_update,
                    data_registro: data_registro,
                    data_usuarios: usuarios,
                }"
                @closeModal="modalCreateUpdate({display: false, data: null})"
            />
            <GenericAlert
                :data_modal="{
                    display: display_generic_alert,
                    data_registro : data_registro,
                    data_proceso : data_proceso
                }"
                @closeModal="modalGenericAlert({display: false, data: null, data_proceso: null})"
            />
        </template>
    </GenericLayout>
</template>

<script setup>
// Vue
import { ref } from 'vue';

// Layouts
import GenericLayout from "@/Layouts/GenericLayout.vue";
import DynamicTable from "@/Components/DynamicTable.vue";

import GenericAlert from "@/Components/GenericAlert.vue";

// Componentes de los modales
import CreateUpdate from "@/Pages/Eventos/CreateUpdate.vue";

// Variables para los modales
const display_create_update = ref(false), display_generic_alert = ref(false);
const data_registro = ref(null), data_proceso = ref(null)

// Métodos
const modalCreateUpdate = (event) => {
    display_create_update.value = event.display;
    data_registro.value = event?.data ?? null;
}

const modalGenericAlert = (event) => {
    data_registro.value = event.data;
    display_generic_alert.value = event.display;
    data_proceso.value = event.proceso;
}

// Propiedades
const props = defineProps({
    eventos: {
        type: Object,
        default: null
    },
    usuarios: {
        type: Object,
        default: null
    }
})

// Array-Object para los items del DataTable
const items = ref([
    {
        dataField: {
            field: 'id',
            header : 'ID',
            sortable: true,
            type: 'text',
        },
        filters: {
            active: true,
            type: 'numeric',
            minFractionDigits: 0,
            maxFractionDigits: 0,
        },
    },
    {
        dataField: {
            field: 'id_usuario',
            header : 'Encargado',
            sortable: true,
            type: 'text',
        },
        filters: {
            active: true,
            type: 'text',
        },
    },
    {
        dataField: {
            field: 'nombre',
            header : 'Nombre del evento',
            sortable: true,
            type: 'text',
        },
        filters: {
            active: true,
            type: 'text',
        },
    },
    {
        dataField: {
            field: 'fecha_evento',
            header : 'Fecha del evento',
            sortable: true,
            type: 'date',
        },
        filters: {
            active: true,
            type: 'date',
        },
    },
])

</script>