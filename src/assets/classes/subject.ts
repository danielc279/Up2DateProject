/**
 * Contains the data for an episode.
 */
export class Subject
{
    name: string;

    constructor(
        name?: string,
    )
    {
        this.name = name || "";
    }
}