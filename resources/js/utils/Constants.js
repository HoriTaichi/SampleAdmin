export default {
    state:{
        accountId: '',
        accountName: '',
        role: '',
    },
    mutations: {
        updateUser(state, payload){
            state.accountId = payload.accountId
            state.accountName = payload.accountName
            state.role = payload.role
        }
    }



}