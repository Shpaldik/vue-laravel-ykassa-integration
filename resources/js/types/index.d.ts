// resources/js/types/index.d.ts

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    balance: number;
}

export type PageProps<T extends Record<string, unknown> = {}> = T & {
    auth: {
        user: User | null; 

    };
};
