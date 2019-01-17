/**
 * Contains the data for an episode.
 */
export class Attended
{
    present: number;

    total: number;

    constructor(
        present?: number,
        total?: number,
    )
    {
        this.present = present || 0;
        this.total = total || 0;
    }
}