/**
 * Contains the data for an episode.
 */
export class Assignment
{
    id: number;

    subject_id: number;

    name: string;
    
    due_date: number;

    description: string;

    points: number;

    constructor(
        id?: number,
        subject_id?: number,
        name?: string,
        due_date?: number,
        description?: string,
        points?: number,
    )
    {
        this.id = id || 0;
        this.subject_id = subject_id || 0;
        this.name = name || "";
        this.due_date = due_date || 0;
        this.description = description || "";
        this.points = points || 0;
    }
}