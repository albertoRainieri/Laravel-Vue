export default class Gate{

    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.type === 'admin';
    }

    isUser(){
        return this.user.type === 'user';
    }

    isSupplier(){
        return this.user.type === 'supplier';
    }

    isAdminOrUser(){
        return this.user.type === 'admin';

        if(this.user.type === 'user' || this.user.type === 'admin'){
            return true;
        }
    }

    isSupplierOrAdmin(){
        if(this.user.type === 'supplier' || this.user.type === 'admin'){
            return true;
        }
        else
        {
            return false
        }
    }
}

