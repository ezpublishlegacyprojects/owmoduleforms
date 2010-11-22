<div class="border-box">
    <div class="border-tl">
        <div class="border-tr">
            <div class="border-tc"></div>
        </div>
    </div>
    <div class="border-ml">
        <div class="border-mr">
            <div class="border-mc float-break">
                <div class="owmoduleforms">
                    <h1>{$confirm_message}</h1>
                    <h2>Your submitted data:</h2>
                    <ul>
                        {foreach $submitted_data as $data}
                            <li><strong>{$data.label}:</strong>
	                            {if eq('owFormFile', $data.type)}
	                                 <img src={$data.value.upload_file_path|ezroot()} />
	                            {else}
	                                <span>{$data.value}</span></li>
	                            {/if}
                            </li>
                        {/foreach}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="border-bl">
        <div class="border-br">
            <div class="border-bc"></div>
        </div>
    </div>
</div>