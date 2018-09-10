import Constants from '@/utils/Constants'
export default {
    state:{
        accountId: '',
        accountName: '',
        role: '',
    },
    getters:{
        getRoleName: state => {
            return Constants.ROLE.NAMES[state.role]
        }
    },
    mutations: {
        updateUser(state, payload){
            state.accountId = payload.accountId
            state.accountName = payload.accountName
            state.role = payload.role
        }
    }



}