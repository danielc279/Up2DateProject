/**
 * Contains the data for an episode.
 */
export class Attended2
{
    present: number;

    total: number;

    name: string;

    constructor(
        present?: number,
        total?: number,
        name?: string,
    )
    {
        this.present = present || 0;
        this.total = total || 0;
        this.name = name || "";
    }
}